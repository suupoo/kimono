<?php

namespace App\Models;

use App\Models\Scopes\OwnerScope;
use App\Models\Traits\ModelFillOwnerIdObservable;
use App\ValueObjects\Store\Address1;
use App\ValueObjects\Store\Address2;
use App\ValueObjects\Store\Code;
use App\ValueObjects\Store\CreatedAt;
use App\ValueObjects\Store\DeletedAt;
use App\ValueObjects\Store\Id;
use App\ValueObjects\Store\Name;
use App\ValueObjects\Store\OwnerSequenceNo;
use App\ValueObjects\Store\OwnerSystemCompany;
use App\ValueObjects\Store\PostCode;
use App\ValueObjects\Store\Prefecture;
use App\ValueObjects\Store\Tags;
use App\ValueObjects\Store\UpdatedAt;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ScopedBy([OwnerScope::class])]
class Store extends Model
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
            new UpdatedAt,
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
