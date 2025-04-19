<?php

return [
    'app_name'      => env('APP_NAME', 'Filament Footer'),
    'github'        => [
        'repository' => env('GITHUB_REPOSITORY', ''),
        'token'      => env('GITHUB_TOKEN', ''),
        'cache_ttl'  => env('GITHUB_CACHE_TTL', 3600),
    ],
    'website_url'   => env('WEBSITE_URL', 'https://cbiha.com'),
    'developer_url' => env('DEVELOPER_URL', 'https://iracode.com'),
];
