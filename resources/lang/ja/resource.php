<?php

declare(strict_types=1);

return [
    'list' => '',
    'create' => '新規作成',
    'store' => '登録',
    'edit' => '編集',
    'update' => '更新',
    'delete' => '削除',
    'show' => '詳細',
    'search' => '検索',
    'copy' => '複製',
    'export' => 'エクスポート',
    'search_condition' => '検索条件',
    'operation' => '操作',
    'operation-relation' => 'リレーション',
    'cancel' => 'キャンセル',
    'is_delete_selected_data' => '選択したデータを削除しますか？',
    'close_modal' => 'モーダルを閉じる',

    // リソース
    'meta' => [
        \App\Models\Customer::class => [
            'description' => "顧客情報を管理する機能です\n顧客の追加、編集、削除、CSVエクスポート、PDFエクスポートなどの操作が可能です。",
        ],
        \App\Models\Staff::class => [
            'description' => "スタッフ情報を管理する機能です。\nスタッフの追加、編集、削除、CSVエクスポートなどの操作が可能です。",
        ],
        \App\Models\Store::class => [
            'description' => "店舗情報を管理する機能です。\n店舗の追加、編集、削除、CSVエクスポートなどの操作が可能です。",
        ],
        \App\Models\Stock::class => [
            'description' => "在庫情報を管理する機能です。\n在庫の追加、編集、削除、CSVエクスポートなどの操作が可能です。",
        ],
        \App\Models\User::class => [
            'description' => "ユーザー情報を管理する機能です。\nユーザーの追加、編集、削除、CSVエクスポートなどの操作が可能です。",
        ],
        \App\Models\Notification::class => [
            'description' => "通知情報を管理する機能です。\n通知の追加、編集、削除、CSVエクスポートなどの操作が可能です。",
        ],
        \App\Models\Company::class => [
            'description' => "企業情報を管理する機能です\n企業の追加、編集、削除、CSVエクスポートなどの操作が可能です。",
        ],
        \App\Models\Attendance::class => [
            'description' => "勤怠情報を管理する機能です。\n勤怠の追加、編集、削除、CSVエクスポートなどの操作が可能です。",
        ],
    ]
];
