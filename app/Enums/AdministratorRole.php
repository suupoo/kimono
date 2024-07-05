<?php

namespace App\Enums;

enum AdministratorRole: string
{
    case NORMAL = 'normal';
    case ADMIN = 'admin';

    public function label(): ?string
    {
        return match ($this) {
            self::NORMAL => '一般',
            self::ADMIN => '管理者',
        };
    }
}
