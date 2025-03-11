<?php

namespace App\Models;

use App\Models\Traits\ModelFillOwnerIdObservable;
use App\ValueObjects\Attendance\WorkingObject;
use App\ValueObjects\Column\Attendance\CreatedAt;
use App\ValueObjects\Column\Attendance\CreatedUser;
use App\ValueObjects\Column\Attendance\DeletedAt;
use App\ValueObjects\Column\Attendance\EndDate;
use App\ValueObjects\Column\Attendance\EndTime;
use App\ValueObjects\Column\Attendance\Id;
use App\ValueObjects\Column\Attendance\StaffId;
use App\ValueObjects\Column\Attendance\StartDate;
use App\ValueObjects\Column\Attendance\StartTime;
use App\ValueObjects\Column\Attendance\Uuid;
use App\ValueObjects\Column\Attendance\OwnerSequenceNo;
use App\ValueObjects\Column\Attendance\OwnerSystemCompany;
use App\ValueObjects\Column\Attendance\UpdatedAt;
use App\ValueObjects\Column\Attendance\UpdatedUser;
use App\Models\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ScopedBy([OwnerScope::class])]
class Attendance extends BaseModel
{
    use HasFactory, ModelFillOwnerIdObservable, SoftDeletes;

    protected $table = 'attendances';

    const NAME = '勤怠';

    protected $casts = [];

    protected $guarded = [
        'id',
        'owner_sequence_no',
        'owner_system_company',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * カラムを定義する関数
     */
    public static function getColumns(): array
    {
        return [
            new Id,
            new OwnerSequenceNo,
            new OwnerSystemCompany,
            new Uuid,
            new StaffId,
            new StartDate,
            new StartTime,
            new EndDate,
            new EndTime,
            new CreatedAt,
            new CreatedUser,
            new UpdatedAt,
            new UpdatedUser,
            new DeletedAt,
        ];
    }

    /**
     * 勤務時間オブジェクトを返す
     * @return Attribute
     * @throws \Exception
     */
    protected function working(): Attribute
    {
        return Attribute::make(
            get: function ($value, array $attributes) {
                return new WorkingObject($attributes);
            },
        );
    }
}
