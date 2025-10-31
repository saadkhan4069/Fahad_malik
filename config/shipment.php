<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Shipment System Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration settings specific to the shipment booking system.
    |
    */

    'cost_calculation' => [
        'base_cost' => env('SHIPMENT_BASE_COST', 100),
        'weight_rate' => env('SHIPMENT_WEIGHT_RATE', 50),
        'volume_rate' => env('SHIPMENT_VOLUME_RATE', 10),
        'tax_rate' => env('SHIPMENT_TAX_RATE', 5),
    ],

    'service_multipliers' => [
        'standard' => 1,
        'express' => env('SHIPMENT_EXPRESS_MULTIPLIER', 1.5),
        'overnight' => env('SHIPMENT_OVERNIGHT_MULTIPLIER', 2),
        'international' => env('SHIPMENT_INTERNATIONAL_MULTIPLIER', 3),
    ],

    'invoice' => [
        'prefix' => env('INVOICE_PREFIX', 'INV'),
        'due_days' => env('INVOICE_DUE_DAYS', 30),
        'tax_rate' => env('INVOICE_TAX_RATE', 5),
    ],

    'label' => [
        'width' => env('LABEL_WIDTH', 400),
        'height' => env('LABEL_HEIGHT', 600),
        'margin' => env('LABEL_MARGIN', 10),
    ],

    'file_upload' => [
        'max_size' => env('MAX_FILE_SIZE', 10240), // KB
        'allowed_types' => explode(',', env('ALLOWED_FILE_TYPES', 'pdf,jpg,jpeg,png')),
    ],

    'booking' => [
        'number_prefix' => 'BK',
        'auto_confirm' => env('BOOKING_AUTO_CONFIRM', false),
    ],

    'shipment' => [
        'tracking_prefix' => 'TR',
        'auto_generate_tracking' => env('SHIPMENT_AUTO_GENERATE_TRACKING', true),
    ],

    'company' => [
        'auto_approve' => env('COMPANY_AUTO_APPROVE', true),
        'require_verification' => env('COMPANY_REQUIRE_VERIFICATION', false),
    ],
];
