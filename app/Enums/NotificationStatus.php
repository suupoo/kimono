<?php

namespace App\Enums;

enum NotificationStatus: string
{
    case DRAFT = 'draft';
    case SCHEDULED = 'scheduled';
    case COMPLETE = 'complete';

    public function label(): ?string
    {
        return match ($this) {
            self::DRAFT => '下書き',
            self::SCHEDULED => '予約',
            self::COMPLETE => '配信済み',
        };
    }
}
