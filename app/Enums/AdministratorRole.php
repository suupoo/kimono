<?php

namespace App\Enums;

enum AdministratorRole: string
{
    case NORMAL = 'normal';
    case ADMIN = 'admin';
    case SYSTEM = 'system';

    public function label(): ?string
    {
        return match ($this) {
            self::NORMAL => '一般',
            self::ADMIN => '管理者',
            self::SYSTEM => 'システム',
        };
    }

    public static function casesExpectSystem(): array
    {
        return array_filter(self::cases(), function ($enum) {
            return $enum !== self::SYSTEM;
        });
    }
}
