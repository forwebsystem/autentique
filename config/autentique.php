<?php

return [
    'url'=> env('AUTENTIQUE_URL', 'https://api.autentique.com.br/v2/graphql'),
    'token'=> env('AUTENTIQUE_TOKEN', ''),
    'dev_mode'=> env('AUTENTIQUE_DEV_MODE', false),
    'channels' => [
        'autentiquelogs' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'visibility' => 'public',
        ]
    ]
];