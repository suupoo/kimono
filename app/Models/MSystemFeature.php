<?php

namespace App\Models;

use App\ValueObjects\Master\Feature\Enable;
use App\ValueObjects\Master\Feature\Key;
use App\ValueObjects\Store\Name;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MSystemFeature extends Model
{
    use HasFactory;

    protected $table = 'm_system_features';

    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = 'key';

    protected $keyType = 'string';

    const NAME = 'システム機能設定';

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
