<?php

return [
    // ID and SECRETS
    'client_id'              => env('SSO_CLIENT_ID'),
    'client_secret'          => env('SSO_CLIENT_SECRET'),

    // Urls
    'base_url'               => env('SSO_BASE_URL'),
    'authorize_url'          => env('SSO_AUTHORIZE_URL'),
    'request_auth_token_url' => env('SSO_REQUEST_AUTH_TOKEN_URL'),
    'request_user_info_url'  => env('SSO_REQUEST_USER_INFO_URL'),
    'redirect_uri'           => env('SSO_REDIRECT_URI'),

    // Token
    'sso_token_lifetime'     => env('SSO_TOKEN_LIFETIME'),
    'sso_encryption_key'     => env('SSO_ENCRYPTION_KEY'),
];
