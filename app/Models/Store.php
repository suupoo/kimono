<?php

namespace App\Models;

use App\Models\Scopes\OwnerScope;
use App\Models\Traits\ModelFillOwnerIdObservable;
use App\ValueObjects\Column\Store\Address1;
use App\ValueObjects\Column\Store\Address2;
use App\ValueObjects\Column\Store\Code;
use App\ValueObjects\Column\Store\CreatedAt;
use App\ValueObjects\Column\Store\CreatedUser;
use App\ValueObjects\Column\Store\DeletedAt;
use App\ValueObjects\Column\Store\Id;
use App\ValueObjects\Column\Store\Name;
use App\ValueObjects\Column\Store\OwnerSequenceNo;
use App\ValueObjects\Column\Store\OwnerSystemCompany;
use App\ValueObjects\Column\Store\PostCode;
use App\ValueObjects\Column\Store\Prefecture;
use App\ValueObjects\Column\Store\Tags;
use App\ValueObjects\Column\Store\UpdatedAt;
use App\ValueObjects\Column\Store\UpdatedUser;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ScopedBy([OwnerScope::class])]
class Store extends BaseModel
{
    use HasFactory, ModelFillOwnerIdObservable, SoftDeletes;

    protected $table = 'stores';

    const NAME = '店舗';

    protected $casts = [
        Prefecture::NAME => \App\Enums\Prefecture::class,
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
            new Name,
            new Code,
            new PostCode,
            new Prefecture,
            new Address1,
            new Address2,
            new Tags,
            new CreatedAt,
            new CreatedUser,
            new UpdatedAt,
            new UpdatedUser,
            new DeletedAt,
        ];
    }

    public function staffs()
    {
        return $this->belongsToMany(
            Staff::class,
            'stores_staffs',
            'store_id',
            'staff_id',
        );
    }
}
