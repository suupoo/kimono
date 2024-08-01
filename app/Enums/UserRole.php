<?php

namespace App\Enums;

enum UserRole: string
{
    case NORMAL = 'normal';
    case ADMIN = 'admin';

    public function label(): ?string
    {
        return match ($this) {
            self::NORMAL => '一般ユーザー',
            self::ADMIN => '管理者',
        };
    }
}
