<?php

namespace App\Models;

use App\Facades\Utility\CustomStorage;
use App\Models\Scopes\OwnerScope;
use App\Models\Traits\ModelFillOwnerIdObservable;
use App\ValueObjects\Staff\Code;
use App\ValueObjects\Staff\CreatedAt;
use App\ValueObjects\Staff\CreatedUser;
use App\ValueObjects\Staff\Id;
use App\ValueObjects\Staff\Image;
use App\ValueObjects\Staff\JoinDate;
use App\ValueObjects\Staff\Name;
use App\ValueObjects\Staff\OwnerSystemCompany;
use App\ValueObjects\Staff\QuitDate;
use App\ValueObjects\Staff\Tel;
use App\ValueObjects\Staff\UpdatedAt;
use App\ValueObjects\Staff\UpdatedUser;
use App\ValueObjects\Staff\StaffPosition;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[ScopedBy([OwnerScope::class])]
class Staff extends BaseModel
{
    use HasFactory, ModelFillOwnerIdObservable;

    protected $table = 'staffs';

    const NAME = 'スタッフ';

    protected $casts = [
        StaffPosition::NAME => \App\Enums\StaffPosition::class,
    ];

    protected $guarded = [
        'id',
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
            new OwnerSystemCompany,
            new Image,
            new Name,
            new Code,
            new Tel,
            new StaffPosition,
            new JoinDate,
            new QuitDate,
            new CreatedAt,
            new CreatedUser,
            new UpdatedAt,
            new UpdatedUser,
        ];
    }

    /**
     * アクセサ：画像URLを取得する
     * @note $this->image で呼び出す
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? CustomStorage::disk()->temporaryUrl(
            $this->image,
            Carbon::now()->addMinutes(5)
        ) : null;
    }
}
