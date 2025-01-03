<?php

namespace App\Enums;

enum Locale: string
{
    case JP = 'JP';

    public function label(): ?string
    {
        return match ($this) {
            self::JP => '日本',
        };
    }
}
