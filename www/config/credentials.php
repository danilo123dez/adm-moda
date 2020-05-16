<?php

return [
    'API_URL' => env('API_URL', 'http://app/v1/'),
    'OAUTH_URL' => env('OAUTH_URL', 'http://app/oauth/token'),

    'CLIENT_ID' => env('CLIENT_ID', 1),
    'CLIENT_SECRET' => env('CLIENT_SECRET'),

    'CLIENT_ID_PASS' => env('CLIENT_ID_PASS',2),
    'CLIENT_SECRET_PASS' => env('CLIENT_SECRET_PASS')
];
