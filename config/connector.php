<?php

return [
    'database' => [
        'internal' => [
            'connection' => env('INTERNAL_DATABASE_CONNECTION', 'sqlite')
        ],

        'external' => [
            'connection' => env('EXTERNAL_DATABASE_CONNECTION', 'mysql')
        ]
    ]
];
