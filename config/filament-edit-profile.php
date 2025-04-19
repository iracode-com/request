<?php

return [
    'avatar_column' => 'avatar_url',
    'disk' => env('FILESYSTEM_DISK', 'local'),
    'visibility' => 'public', // or replace by filesystem disk visibility with fallback value
];
