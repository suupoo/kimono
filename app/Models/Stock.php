<?php

namespace App\Models;

use App\Facades\Utility\CustomStorage;
use App\Models\Scopes\OwnerScope;
use App\Models\Traits\ModelFillOwnerIdObservable;
use App\ValueObjects\Stock\CreatedAt;
use App\ValueObjects\Stock\CreatedUser;
use App\ValueObjects\Stock\DeletedAt;
use App\ValueObjects\Stock\Id;
use App\ValueObjects\Stock\Image;
use App\ValueObjects\Stock\Name;
use App\ValueObjects\Stock\OwnerSequenceNo;
use App\ValueObjects\Stock\OwnerSystemCompany;
use App\ValueObjects\Stock\Price;
use App\ValueObjects\Stock\Quantity;
use App\ValueObjects\Stock\Tags;
use App\ValueObjects\Stock\UpdatedAt;
use App\ValueObjects\Stock\UpdatedUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ScopedBy([OwnerScope::class])]
class Stock extends BaseModel
{
    use HasFactory, ModelFillOwnerIdObservable, SoftDeletes;

    protected $table = 'stocks';

    const NAME = '在庫';

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
            new Image,
            new Name,
            new Quantity,
            new Price,
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
}
