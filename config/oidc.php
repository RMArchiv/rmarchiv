<?php

return [
    'enabled' => env('OIDC_ENABLED', false),

    'issuer' => env('OIDC_ISSUER', ''),
    'client_id' => env('OIDC_CLIENT_ID', ''),
    'client_secret' => env('OIDC_CLIENT_SECRET', ''),
    'redirect_uri' => env('OIDC_REDIRECT_URI', env('APP_URL').'/auth/oidc/callback'),

    'scopes' => env('OIDC_SCOPES', 'openid email profile'),

    'auto_register' => env('OIDC_AUTO_REGISTER', true),
    'link_existing_users_by_email' => env('OIDC_LINK_EXISTING_USERS_BY_EMAIL', true),
    'require_verified_email_for_linking' => env('OIDC_REQUIRE_VERIFIED_EMAIL_FOR_LINKING', true),

    'default_role_id' => env('OIDC_DEFAULT_ROLE_ID', 4),
];
