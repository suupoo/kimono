<?php

namespace App\Models;

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

    public $incrementing = false;

    protected $primaryKey = [
        Date::NAME,
        Locale::NAME,
    ];

    protected $keyType = 'array';

    const NAME = '祝日設定';

    protected $guarded = [
        'id',
    ];

    public function getColumns(): array
    {
        return [
            new Date,
            new Locale,
            new Name,
        ];
    }

}
