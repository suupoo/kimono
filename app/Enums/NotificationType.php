<?php

namespace App\Enums;

enum NotificationType: string
{
    case PUSH = 'push';
    case MAIL = 'mail';
    case POPUP = 'popup';

    public function label(): ?string
    {
        return match ($this) {
            self::PUSH => 'プッシュ通知',
            self::POPUP => 'ポップアップ通知',
            self::MAIL => 'メール通知',
        };
    }
}
