<?php

declare(strict_types=1);

return [
    
    /**
     * Configure modules
     */
    'json_enabled' => env('MUNK_JSON_ENABLED', true),
    'meta_enabled' => env('MUNK_META_ENABLED', true),

    'schema' => [
        'include_products' => true,
        'include_faqs' => true,
        'include_reviews' => true,
        'include_breadcrumb' => true,
        'include_raw_json' => false,
    ],

];
