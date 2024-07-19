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
    'staffs' => 'スタッフ',
    'administrators' => '管理者',
    'system' => [
        '*' => 'システム',
        'features' => '機能設定'
    ],
    'me' => [
        '*' => '個人設定',
    ],
];
