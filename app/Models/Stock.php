<?php

namespace App\Models;

use App\Facades\Utility\CustomStorage;
use App\Models\Scopes\OwnerScope;
use App\Models\Traits\ModelFillOwnerIdObservable;
use App\ValueObjects\Column\Stock\CreatedAt;
use App\ValueObjects\Column\Stock\CreatedUser;
use App\ValueObjects\Column\Stock\DeletedAt;
use App\ValueObjects\Column\Stock\Id;
use App\ValueObjects\Column\Stock\Image;
use App\ValueObjects\Column\Stock\Name;
use App\ValueObjects\Column\Stock\OwnerSequenceNo;
use App\ValueObjects\Column\Stock\OwnerSystemCompany;
use App\ValueObjects\Column\Stock\Price;
use App\ValueObjects\Column\Stock\Quantity;
use App\ValueObjects\Column\Stock\Tags;
use App\ValueObjects\Column\Stock\UpdatedAt;
use App\ValueObjects\Column\Stock\UpdatedUser;
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
