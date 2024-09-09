<?php

namespace App\Models;

use App\Facades\Utility\CustomStorage;
use App\Models\Traits\ModelFillOwnerIdObservable;
use App\ValueObjects\Column\Master\Banner\CreatedAt;
use App\ValueObjects\Column\Master\Banner\CreatedUser;
use App\ValueObjects\Column\Master\Banner\Id;
use App\ValueObjects\Column\Master\Banner\Image;
use App\ValueObjects\Column\Master\Banner\Priority;
use App\ValueObjects\Column\Master\Banner\Text;
use App\ValueObjects\Column\Master\Banner\UpdatedAt;
use App\ValueObjects\Column\Master\Banner\UpdatedUser;
use App\ValueObjects\Column\Master\Banner\Url;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MSystemBanner extends BaseModel
{
    use HasFactory, ModelFillOwnerIdObservable;

    protected $table = 'm_system_banners';

    const NAME = 'バナー広告';

    protected $guarded = [
        'id',
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
            new Image,
            new Text,
            new Url,
            new Priority,
            new CreatedAt,
            new CreatedUser,
            new UpdatedAt,
            new UpdatedUser,
        ];
    }

    /**
     * アクセサ：画像URLを取得する
     *
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
