<?php

namespace App\Models;

use App\ValueObjects\M_Function\Enable;
use App\ValueObjects\M_Function\Key;
use App\ValueObjects\Store\Name;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MSystemFunction extends Model
{
    use HasFactory;

    protected $table = 'm_functions';

    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = 'key';

    protected $keyType = 'string';

    const NAME = 'システム機能マスタ';

    protected $casts = [];

    protected $guarded = [];

    /**
     * カラムを定義する関数
     */
    public static function getColumns(): array
    {
        return [
            new Key,
            new Name,
            new Enable
        ];
    }
}
