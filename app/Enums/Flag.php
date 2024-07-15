<?php

namespace App\Enums;

enum Flag: int
{
    case ON = 1;
    case OFF = 0;

    public function label(): ?string
    {
        return match ($this) {
            self::ON => '有効',
            self::OFF => '無効',
        };
    }
}
