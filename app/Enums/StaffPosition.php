<?php

namespace App\Enums;

enum StaffPosition: string
{
    case NONE = '0000';
    case PRESIDENT = '0001';
    case VICE_PRESIDENT = '0002';
    case BUCHO = '1000';
    case JICHO = '1001';
    case KACHO = '1002';
    case KAKARICHO = '1003';
    case SHUNIN = '1004';
    case SHAIN = '1005';

    public function label(): ?string
    {
        return match ($this) {
            self::NONE => '未選択',
            self::PRESIDENT => '社長',
            self::VICE_PRESIDENT => '副社長',
            self::BUCHO => '部長',
            self::JICHO => '次長',
            self::KACHO => '課長',
            self::KAKARICHO => '係長',
            self::SHUNIN => '主任',
            self::SHAIN => '社員',
            default => null,
        };
    }
}
