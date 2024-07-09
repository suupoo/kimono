<?php

namespace App\Enums;

enum StaffPosition: string
{
    case NONE = '0000';
    case MANAGER = '0001';

    public function label(): ?string
    {
        return match ($this) {
            self::NONE => '未選択',
            self::MANAGER => 'マネージャー',
            default => null,
        };
    }
}
