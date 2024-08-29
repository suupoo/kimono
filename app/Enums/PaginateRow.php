<?php

namespace App\Enums;

enum PaginateRow: string
{
    case ROWS_25   = '25';
    case ROWS_50   = '50';
    case ROWS_100  = '100';
    case ROWS_1000 = '1000';

    public function label(): ?string
    {
        return match ($this) {
            self::ROWS_25 => '25',
            self::ROWS_50 => '50',
            self::ROWS_100 => '100',
            self::ROWS_1000 => '1000',
        };
    }
}
