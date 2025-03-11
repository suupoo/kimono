<?php

namespace App\Models;

use App\Facades\Utility\CustomStorage;
use App\Models\Scopes\OwnerScope;
use App\Models\Traits\ModelFillOwnerIdObservable;
use App\ValueObjects\Column\Staff\Code;
use App\ValueObjects\Column\Staff\CreatedAt;
use App\ValueObjects\Column\Staff\CreatedUser;
use App\ValueObjects\Column\Staff\DeletedAt;
use App\ValueObjects\Column\Staff\Id;
use App\ValueObjects\Column\Staff\Image;
use App\ValueObjects\Column\Staff\JoinDate;
use App\ValueObjects\Column\Staff\Name;
use App\ValueObjects\Column\Staff\OwnerSequenceNo;
use App\ValueObjects\Column\Staff\OwnerSystemCompany;
use App\ValueObjects\Column\Staff\QuitDate;
use App\ValueObjects\Column\Staff\StaffPosition;
use App\ValueObjects\Column\Staff\Tags;
use App\ValueObjects\Column\Staff\Tel;
use App\ValueObjects\Column\Staff\UpdatedAt;
use App\ValueObjects\Column\Staff\UpdatedUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ScopedBy([OwnerScope::class])]
class Staff extends BaseModel
{
    use HasFactory, ModelFillOwnerIdObservable, SoftDeletes;

    protected $table = 'staffs';

    const NAME = 'スタッフ';

    protected $casts = [
        StaffPosition::NAME => \App\Enums\StaffPosition::class,
    ];

    protected $guarded = [
        'id',
        'owner_sequence_no',
        'owner_system_company',
        'created_at',
        'updated_at',
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
            new Image,
            new Name,
            new Code,
            new Tel,
            new StaffPosition,
            new JoinDate,
            new QuitDate,
            new Tags,
            new CreatedAt,
            new CreatedUser,
            new UpdatedAt,
            new UpdatedUser,
            new DeletedAt,
        ];
    }

    /**
     * アクセサ：画像URLを取得する
     *
     * @note $this->image で呼び出す
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? CustomStorage::userDisk()->temporaryUrl(
            $this->image,
            Carbon::now()->addMinutes(5)
        ) : null;
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
