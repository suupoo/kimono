<?php

declare(strict_types=1);

/**
 * カスタム設定
 */
return [
    'breadcrumbs' => [
        'use' => env('CUSTOM_BREADCRUMBS_USE', true),
        'separator' => (' '.env('CUSTOM_BREADCRUMBS_SEPARATOR', '/').' '),
    ],
    'paginate' => [
        'default' => 25,
    ],
    'file' => [
        'image' => [
            'extensions' => [
                'jpg',
            ],
        ],
    ],
    'footer' => [
        'inquiry' => [
            'form' => env('CUSTOM_FOOTER_INQUIRY_FORM'),
        ],
    ],
];
