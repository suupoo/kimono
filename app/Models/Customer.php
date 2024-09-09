<?php

namespace App\Models;

use App\Models\Scopes\OwnerScope;
use App\Models\Traits\ModelFillOwnerIdObservable;
use App\ValueObjects\Column\Customer\Address1;
use App\ValueObjects\Column\Customer\Address2;
use App\ValueObjects\Column\Customer\CreatedAt;
use App\ValueObjects\Column\Customer\CreatedUser;
use App\ValueObjects\Column\Customer\CustomerName;
use App\ValueObjects\Column\Customer\DeletedAt;
use App\ValueObjects\Column\Customer\Id;
use App\ValueObjects\Column\Customer\Note;
use App\ValueObjects\Column\Customer\OwnerSequenceNo;
use App\ValueObjects\Column\Customer\OwnerSystemCompany;
use App\ValueObjects\Column\Customer\PostCode;
use App\ValueObjects\Column\Customer\Prefecture;
use App\ValueObjects\Column\Customer\Tags;
use App\ValueObjects\Column\Customer\UpdatedAt;
use App\ValueObjects\Column\Customer\UpdatedUser;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ScopedBy([OwnerScope::class])]
class Customer extends BaseModel
{
    use HasFactory, ModelFillOwnerIdObservable, SoftDeletes;

    protected $table = 'customers';

    const NAME = '顧客';

    protected $casts = [
        Prefecture::NAME => \App\Enums\Prefecture::class,
    ];

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
            new CustomerName,
            new PostCode,
            new Prefecture,
            new Address1,
            new Address2,
            new Note,
            new Tags,
            new CreatedAt,
            new CreatedUser,
            new UpdatedAt,
            new UpdatedUser,
            new DeletedAt,
        ];
    }

    /**
     * 住所を取得する
     */
    public function getAddressAttribute(): string
    {
        $prefecture = $this->prefecture?->label();

        return sprintf('%s%s%s', $prefecture, $this->address_1, $this->address_2);
    }
}
