<?php

return [
    'twig' => [
        'options' => [
            'cache' => __DIR__ . '/src/resources/compilation_cache',
            'auto_reload' => true
        ],
        'loader_paths' => __DIR__ . '/src/resources/templates',
    ]
];
