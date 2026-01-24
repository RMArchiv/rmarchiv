<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApiTokenAuth
{
    public function handle(Request $request, Closure $next)
    {
        $token = $this->extractToken($request);

        if (! $token) {
            return response()->json([
                'status_code' => 401,
                'message' => 'Missing API token.',
            ], 401);
        }

        $hashedToken = hash('sha256', $token);
        $user = User::where('api_token', '=', $hashedToken)->first();

        if (! $user) {
            return response()->json([
                'status_code' => 401,
                'message' => 'Invalid API token.',
            ], 401);
        }

        $user->api_token_last_used_at = now();
        $user->save();

        Auth::setUser($user);

        return $next($request);
    }

    private function extractToken(Request $request): ?string
    {
        $header = $request->header('Authorization', '');
        if ($header !== '' && Str::startsWith($header, 'Bearer ')) {
            return trim(Str::after($header, 'Bearer '));
        }

        $token = $request->header('X-Api-Token');
        if ($token) {
            return $token;
        }

        return $request->query('api_token');
    }
}
