<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Kimono Core Configuration
    |--------------------------------------------------------------------------
    |
    | パッケージの動作を制御するための設定です。
    |
    */

    /** Kimono Coreを使用するかどうか */
    'use' => [
        'core' => true, // Coreを使用するかどうか
        'admin' => true, // Adminを使用するかどうか
    ],

    'storage' => [
        'disk' => env('FILESYSTEM_DISK', 'local'),
    ],

    /**
     * Kimono Coreの設定
     */

    /**
     * リソース生成
     */
    'resources' => [
        'controllers' => [
            // 定義先コントローラファイル
            'directory' => 'app/Http/Controllers',
            'namespace' => 'App\Http\Controllers',
        ],
        'actions' => [
            'use' => true,
            // 定義先アクションファイル
            'directory' => 'app/UseCases',
            'namespace' => 'App\UseCases',
        ],
        'models' => [
            // 定義先モデルファイル
            'directory' => 'app/Models',
            'namespace' => 'App\Models',
        ],
        'routes' => [
            // 定義先ルーティングファイル
            'directory' => '/routes',
            'file' => 'resources.php',
        ],
        'pagination' => [
            'default' => 10, // デフォルトのページネーション数
            'list' => [10, 20, 50, 100], // ページネーションの選択肢
        ],
    ],
    'documents' => [
        'table' => [
            'file' => 'documents/table-definition.md',
        ],
        'routing' => [
            'file' => 'documents/routing.md',
        ],
        'api' => [
            'file' => 'documents/api.md',
        ],
    ],

    /**
     * Kimono Adminの設定
     */
    'admin' => [
        'prefix' => 'kimono/admin', // ルートのプレフィックス
        'login_email' => 'kimono@example.com', // ログイン用メールアドレス
        'login_password' => 'japan', // // ログイン用パスワード
        'rate_limits' => [
            'login' => [
                'attempts' => 1,        // 許可される試行回数
                'decay_minutes' => 5,   // リセットまでの時間（分）
            ],
        ],
        'legal' => [
            'view' => 'kimono::admin.legal', // 利用規約のビュー名
            'terms' => [
                'use' => true, // 利用規約を使用するかどうか
                'route' => [
                    'name' => 'terms',
                    'path' => '/terms',
                    'controller' => \Kimono\Core\Http\Controllers\LegalController::class,
                    'method' => 'terms',
                ],
            ],
            'privacy' => [
                'use' => true, // プライバシーポリシーを使用するかどうか
                'route' => [
                    'name' => 'privacy',
                    'path' => '/privacy',
                    'controller' => \Kimono\Core\Http\Controllers\LegalController::class,
                    'method' => 'privacy',
                ],
            ],
            'commercial_law' => [
                'use' => true, // プライバシーポリシーを使用するかどうか
                'route' => [
                    'name' => 'commercial_law',
                    'path' => '/commercial_law',
                    'controller' => \Kimono\Core\Http\Controllers\LegalController::class,
                    'method' => 'commercialLaw',
                ],
            ],
        ],
    ],
];
