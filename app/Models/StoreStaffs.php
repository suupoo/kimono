<?php

namespace App\Models;

use App\ValueObjects\StoreStaff\Id;
use App\ValueObjects\StoreStaff\StaffId;
use App\ValueObjects\StoreStaff\StoreId;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreStaffs extends BaseModel
{
    use HasFactory;

    protected $table = 'stores_staffs';

    const NAME = '店舗スタッフ';

    public $timestamps = false;

    protected $casts = [];

    protected $guarded = [];

    /**
     * カラムを定義する関数
     */
    public static function getColumns(): array
    {
        return [
            new Id,
            new StaffId,
            new StoreId,
        ];
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
