<?php

namespace App\Http\Controllers\Auth;

use App\Events\Obyx;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class OidcController extends Controller
{
    public function redirect(Request $request)
    {
        if (! config('oidc.enabled')) {
            abort(404);
        }

        $metadata = $this->metadata();
        $state = Str::random(40);
        $nonce = Str::random(40);

        $request->session()->put('oidc_state', $state);
        $request->session()->put('oidc_nonce', $nonce);

        return redirect()->away($metadata['authorization_endpoint'].'?'.http_build_query([
            'client_id' => config('oidc.client_id'),
            'redirect_uri' => config('oidc.redirect_uri'),
            'response_type' => 'code',
            'scope' => config('oidc.scopes'),
            'state' => $state,
            'nonce' => $nonce,
        ], '', '&', PHP_QUERY_RFC3986));
    }

    public function callback(Request $request)
    {
        if (! config('oidc.enabled')) {
            abort(404);
        }

        if ($request->filled('error')) {
            return $this->loginError($request->get('error_description', $request->get('error')));
        }

        if (! hash_equals((string) $request->session()->pull('oidc_state'), (string) $request->get('state'))) {
            return $this->loginError('OIDC state konnte nicht validiert werden.');
        }

        if (! $request->filled('code')) {
            return $this->loginError('OIDC Callback enthielt keinen Authorization Code.');
        }

        try {
            $metadata = $this->metadata();
            $token = $this->exchangeCode($metadata['token_endpoint'], $request->get('code'));
            $idTokenClaims = $this->validateIdToken($token['id_token'] ?? '', $metadata);
            $userinfo = $this->userinfo($metadata['userinfo_endpoint'], $token['access_token'] ?? '');
            $claims = array_merge($idTokenClaims, $userinfo);

            $nonce = (string) $request->session()->pull('oidc_nonce');
            if (! hash_equals($nonce, (string) ($idTokenClaims['nonce'] ?? ''))) {
                return $this->loginError('OIDC nonce konnte nicht validiert werden.');
            }

            $user = $this->findOrCreateUser($claims);
        } catch (\Throwable $exception) {
            report($exception);

            return $this->loginError('OIDC Login ist fehlgeschlagen.');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('/');
    }

    protected function exchangeCode(string $tokenEndpoint, string $code): array
    {
        $form = [
            'grant_type' => 'authorization_code',
            'client_id' => config('oidc.client_id'),
            'client_secret' => config('oidc.client_secret'),
            'redirect_uri' => config('oidc.redirect_uri'),
            'code' => $code,
        ];

        return Http::asForm()
            ->acceptJson()
            ->timeout(10)
            ->post($tokenEndpoint, $form)
            ->throw()
            ->json();
    }

    protected function userinfo(string $userinfoEndpoint, string $accessToken): array
    {
        if ($accessToken === '') {
            throw new \RuntimeException('OIDC access_token fehlt.');
        }

        return Http::withToken($accessToken)
            ->acceptJson()
            ->timeout(10)
            ->get($userinfoEndpoint)
            ->throw()
            ->json();
    }

    protected function metadata(): array
    {
        $issuer = rtrim(config('oidc.issuer'), '/');
        if ($issuer === '' || config('oidc.client_id') === '' || config('oidc.client_secret') === '') {
            throw new \RuntimeException('OIDC ist nicht vollständig konfiguriert.');
        }

        $metadata = Http::acceptJson()
            ->timeout(10)
            ->get($issuer.'/.well-known/openid-configuration')
            ->throw()
            ->json();

        foreach (['authorization_endpoint', 'token_endpoint', 'userinfo_endpoint', 'jwks_uri'] as $key) {
            if (empty($metadata[$key])) {
                throw new \RuntimeException("OIDC Metadata ohne {$key}.");
            }
        }

        return $metadata;
    }

    protected function validateIdToken(string $idToken, array $metadata): array
    {
        if ($idToken === '') {
            throw new \RuntimeException('OIDC id_token fehlt.');
        }

        $parts = explode('.', $idToken);
        if (count($parts) !== 3) {
            throw new \RuntimeException('OIDC id_token ist ungültig.');
        }

        $header = $this->jsonFromJwtPart($parts[0]);
        $claims = $this->jsonFromJwtPart($parts[1]);

        if (($header['alg'] ?? '') !== 'RS256' || empty($header['kid'])) {
            throw new \RuntimeException('OIDC id_token nutzt keinen unterstützten Signaturalgorithmus.');
        }

        $key = $this->jwkForKid($metadata['jwks_uri'], $header['kid']);
        $publicKey = $this->publicKeyFromJwk($key);
        $signature = $this->base64UrlDecode($parts[2]);
        $signedData = $parts[0].'.'.$parts[1];

        if (openssl_verify($signedData, $signature, $publicKey, OPENSSL_ALGO_SHA256) !== 1) {
            throw new \RuntimeException('OIDC id_token Signatur ist ungültig.');
        }

        if (($claims['iss'] ?? '') !== ($metadata['issuer'] ?? config('oidc.issuer'))) {
            throw new \RuntimeException('OIDC issuer stimmt nicht überein.');
        }

        $audience = (array) ($claims['aud'] ?? []);
        if (! in_array(config('oidc.client_id'), $audience, true)) {
            throw new \RuntimeException('OIDC audience stimmt nicht überein.');
        }

        if (! empty($claims['azp']) && $claims['azp'] !== config('oidc.client_id')) {
            throw new \RuntimeException('OIDC authorized party stimmt nicht überein.');
        }

        if (empty($claims['exp']) || (int) $claims['exp'] < time()) {
            throw new \RuntimeException('OIDC id_token ist abgelaufen.');
        }

        return $claims;
    }

    protected function findOrCreateUser(array $claims): User
    {
        $issuer = (string) ($claims['iss'] ?? config('oidc.issuer'));
        $subject = (string) ($claims['sub'] ?? '');
        $email = Str::lower((string) ($claims['email'] ?? ''));

        if ($subject === '' || $email === '') {
            throw new \RuntimeException('OIDC Claims enthalten keine sub/email.');
        }

        return DB::transaction(function () use ($claims, $issuer, $subject, $email) {
            $user = User::where('oidc_provider', $issuer)
                ->where('oidc_subject', $subject)
                ->lockForUpdate()
                ->first();

            if (! $user && config('oidc.link_existing_users_by_email')) {
                $emailVerified = filter_var($claims['email_verified'] ?? false, FILTER_VALIDATE_BOOLEAN);
                if ($emailVerified || ! config('oidc.require_verified_email_for_linking')) {
                    $user = User::where('email', $email)->lockForUpdate()->first();
                }
            }

            if (! $user) {
                if (! config('oidc.auto_register')) {
                    throw new \RuntimeException('OIDC Auto-Registrierung ist deaktiviert.');
                }

                $user = User::create([
                    'name' => $this->nameFromClaims($claims, $email),
                    'email' => $email,
                    'password' => Hash::make(Str::random(64)),
                    'is_admin' => 0,
                    'oidc_provider' => $issuer,
                    'oidc_subject' => $subject,
                    'oidc_last_login_at' => now(),
                ]);

                $this->ensureUserDefaults($user);
                event(new Obyx('register', $user->id));

                return $user;
            }

            $user->forceFill([
                'oidc_provider' => $issuer,
                'oidc_subject' => $subject,
                'oidc_last_login_at' => now(),
            ])->save();

            $this->ensureUserDefaults($user);

            return $user;
        });
    }

    protected function ensureUserDefaults(User $user): void
    {
        if (! $user->settings()->exists()) {
            UserSetting::create([
                'avatar_path' => '',
                'user_id' => $user->id,
                'is_admin' => 0,
                'is_moderator' => 0,
                'is_banned' => 0,
            ]);
        }

        $roleId = config('oidc.default_role_id');
        if ($roleId) {
            $user->roles()->syncWithoutDetaching([$roleId]);
        }
    }

    protected function nameFromClaims(array $claims, string $email): string
    {
        $name = $claims['preferred_username']
            ?? $claims['nickname']
            ?? $claims['name']
            ?? Str::before($email, '@');

        return Str::limit((string) $name, 255, '');
    }

    protected function loginError(string $message)
    {
        return redirect()->route('login')->withErrors(['oidc' => $message]);
    }

    protected function jwkForKid(string $jwksUri, string $kid): array
    {
        $jwks = Http::acceptJson()->timeout(10)->get($jwksUri)->throw()->json();

        foreach ($jwks['keys'] ?? [] as $key) {
            if (($key['kid'] ?? '') === $kid) {
                return $key;
            }
        }

        throw new \RuntimeException('OIDC JWKS enthält den benötigten Key nicht.');
    }

    protected function publicKeyFromJwk(array $jwk): string
    {
        if (($jwk['kty'] ?? '') !== 'RSA' || empty($jwk['n']) || empty($jwk['e'])) {
            throw new \RuntimeException('OIDC JWK ist kein RSA Key.');
        }

        $modulus = $this->base64UrlDecode($jwk['n']);
        $exponent = $this->base64UrlDecode($jwk['e']);

        $components = $this->asn1Sequence(
            $this->asn1Integer($modulus).
            $this->asn1Integer($exponent)
        );

        return "-----BEGIN RSA PUBLIC KEY-----\n".
            chunk_split(base64_encode($components), 64, "\n").
            "-----END RSA PUBLIC KEY-----\n";
    }

    protected function jsonFromJwtPart(string $part): array
    {
        $json = json_decode($this->base64UrlDecode($part), true);

        if (! is_array($json)) {
            throw new \RuntimeException('OIDC JWT enthält ungültiges JSON.');
        }

        return $json;
    }

    protected function base64UrlDecode(string $value): string
    {
        return base64_decode(strtr($value, '-_', '+/').str_repeat('=', (4 - strlen($value) % 4) % 4));
    }

    protected function asn1Integer(string $value): string
    {
        if (ord($value[0]) > 0x7f) {
            $value = "\x00".$value;
        }

        return "\x02".$this->asn1Length(strlen($value)).$value;
    }

    protected function asn1Sequence(string $value): string
    {
        return "\x30".$this->asn1Length(strlen($value)).$value;
    }

    protected function asn1Length(int $length): string
    {
        if ($length < 128) {
            return chr($length);
        }

        $bytes = '';
        while ($length > 0) {
            $bytes = chr($length & 0xff).$bytes;
            $length >>= 8;
        }

        return chr(0x80 | strlen($bytes)).$bytes;
    }
}
