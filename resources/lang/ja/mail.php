<?php

declare(strict_types=1);

use App\Notifications\Mail\CreateSystemAdministratorVerifiedMailNotification;

return [
    'user' => [
        'verify_email' => [
            'system' => [
                'subject' => 'メールアドレス変更の確認',
            ],
        ],
    ],
    CreateSystemAdministratorVerifiedMailNotification::class => 'アカウント登録のお知らせ',
];
