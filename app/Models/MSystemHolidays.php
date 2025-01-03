<?php

namespace App\Models;

use App\ValueObjects\Column\Master\Holiday\Id;
use App\ValueObjects\Column\Master\Holiday\Locale;
use App\ValueObjects\Column\Master\Holiday\Name;
use App\ValueObjects\Column\Master\Holiday\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MSystemHolidays extends Model
{
    use HasFactory;

    protected $table = 'm_system_holidays';

    public $timestamps = false;

    const NAME = '祝日設定';

    protected $guarded = [
        'id',
    ];

    public static function getColumns(): array
    {
        return [
            new Id,
            new Date,
            new Locale,
            new Name,
        ];
    }

}
