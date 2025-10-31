<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Local Development Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration settings for local development environment.
    | Copy this file and rename it to .env.local for your local setup.
    |
    */

    'app' => [
        'name' => 'Shipment System',
        'env' => 'local',
        'debug' => true,
        'url' => 'http://localhost:8000',
    ],

    'database' => [
        'connection' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'shipment_system',
        'username' => 'root',
        'password' => '',
    ],

    'mail' => [
        'driver' => 'log', // Use log driver for local development
        'from_address' => 'hello@shipmentsystem.local',
        'from_name' => 'Shipment System',
    ],

    'cache' => [
        'driver' => 'file',
        'session_driver' => 'file',
        'queue_connection' => 'sync',
    ],

    'shipment' => [
        'base_cost' => 100,
        'weight_rate' => 50,
        'volume_rate' => 10,
        'tax_rate' => 5,
        'express_multiplier' => 1.5,
        'overnight_multiplier' => 2,
        'international_multiplier' => 3,
    ],

    'invoice' => [
        'prefix' => 'INV',
        'due_days' => 30,
        'tax_rate' => 5,
    ],

    'label' => [
        'width' => 400,
        'height' => 600,
        'margin' => 10,
    ],

    'file_upload' => [
        'max_size' => 10240, // KB
        'allowed_types' => ['pdf', 'jpg', 'jpeg', 'png'],
    ],

    'development' => [
        'seed_demo_data' => true,
        'enable_debug_toolbar' => true,
        'log_queries' => true,
    ],
];
