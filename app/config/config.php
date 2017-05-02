<?php

return [
    'twig' => [
        'options' => [
            'cache' => __DIR__ . '/../../src/resources/compilation_cache',
            'auto_reload' => true
        ],
        'loader_paths' => __DIR__ . '/../../src/resources/templates',
    ],
    'doctrine' => [
        'mapping_dirs' => [
            __DIR__."/src",
        ],
        'dev_mode' => true,
        'connection' => [
            'driver' => 'pdo_mysql',
            'dbname' => 'sweet_db',
            'user' => 'root',
            'password' => 'root',
            'host' => 'localhost',
        ],
        'types' => [
        ],
    ],
];
