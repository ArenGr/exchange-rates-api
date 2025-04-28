<?php

return [
    'databases' => [
        'sqlite' => $_SERVER['DOCUMENT_ROOT'] . '/database/logs.db',
    ],
    'urls' => [
        'apis' => [
            'frankfurter' => 'https://api.frankfurter.dev/v1/latest'
        ]
    ],
    'paths' => [
        'views' => $_SERVER['DOCUMENT_ROOT'] . '/resources/views/',
    ]
];
