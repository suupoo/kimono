<?php

declare(strict_types=1);

return [

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
    \App\Models\MSystemFeature::class => [
        'description' => "システムで使用可能な機能の設定を行います。",
    ],
    \App\Models\MSystemHolidays::class => [
        'description' => "システムの祝日情報を管理する機能です。\n追加、編集、削除などの操作が可能です。",
    ],
    \App\Models\MSystemAdministrator::class => [
        'description' => "システムの管理アカウント情報を管理する機能です。\n追加、編集、削除などの操作が可能です。",
    ],
    \App\Models\MSystemBanner::class => [
        'description' => "システムのバナー情報を管理する機能です。\n追加、編集、削除などの操作が可能です。",
    ],
    \App\Models\MSystemCompany::class => [
        'description' => "システムの登録企業情報を管理する機能です。\n追加、編集、削除などの操作が可能です。",
    ],


];
