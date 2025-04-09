<?php

declare(strict_types=1);

/**
 * メニュー名を定義する
 * route名 => メニュー項目名
 */
return [
    'home' => 'ホーム',
    'sidebar' => [
        'resource' => 'リソース',
        'admin' => '管理機能',
    ],
    'attendances' => '勤怠',
    'customers' => '顧客',
    'users' => 'ユーザー',
    'stores' => '店舗',
    'stores.staffs.list' => 'スタッフ',
    'staffs' => 'スタッフ',
    'stocks' => '在庫',
    'notifications' => '通知',
    'companies' => '企業',
    'system' => [
        '*' => 'システム',
        'features' => '機能設定',
        'holidays' => '祝日設定',
        'banners' => 'バナー',
        'companies' => 'システム企業',
        'administrators' => 'システム管理者',
    ],
    'system.administrators.companies.list' => 'システム企業',
    'me' => [
        '*' => '個人設定',
        'company' => '企業設定',
    ],
    'mypage' => [
        '*' => 'マイページ',
    ],
];
