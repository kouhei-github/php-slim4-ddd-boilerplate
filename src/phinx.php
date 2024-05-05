<?php

// Vender autoload for third-party packages
require 'vendor/autoload.php';

return [
    'paths' => [
        'migrations' => 'db/migrations',
        'seeds' => 'db/seeds',
    ],
    'environments' => [
        'default_environment' => 'development',
        'development' => [
            'adapter' => getenv('DB_DRIVER'),
            'host' => getenv('DB_HOST'),
            'name' => getenv('DATABASE'),
            'user' => getenv('USERNAME'),
            'pass' => getenv('USER_PASS'),
            'port' => getenv('PORT'),
        ],
    ],
];