<?php

declare(strict_types=1);

/**
 * メニュー名を定義する
 * route名 => メニュー項目名
 */
return [
    'home' => 'ホーム',
    'customers' => '顧客',
    'users' => 'ユーザー',
    'stores' => '店舗',
    'stores.staffs.list' => 'スタッフ',
    'staffs' => 'スタッフ',
    'notifications' => '通知',
    'companies' => '企業',
    'system' => [
        '*' => 'システム',
        'features' => '機能設定',
        'companies' => 'システム企業',
        'administrators' => 'システム管理者',
    ],
    'system.administrators.companies.list' => 'システム企業',
    'me' => [
        '*' => '個人設定',
    ],
];
