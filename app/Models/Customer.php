<?php

namespace App\Models;

use App\Models\Scopes\OwnerScope;
use App\Models\Traits\ModelFillOwnerIdObservable;
use App\ValueObjects\Customer\Address1;
use App\ValueObjects\Customer\Address2;
use App\ValueObjects\Customer\CreatedAt;
use App\ValueObjects\Customer\CreatedUser;
use App\ValueObjects\Customer\CustomerName;
use App\ValueObjects\Customer\Id;
use App\ValueObjects\Customer\Note;
use App\ValueObjects\Customer\OwnerSystemCompany;
use App\ValueObjects\Customer\PostCode;
use App\ValueObjects\Customer\Prefecture;
use App\ValueObjects\Customer\UpdatedAt;
use App\ValueObjects\Customer\UpdatedUser;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[ScopedBy([OwnerScope::class])]
class Customer extends BaseModel
{
    use HasFactory, ModelFillOwnerIdObservable;

    protected $table = 'customers';

    const NAME = '顧客';

    protected $casts = [
        Prefecture::NAME => \App\Enums\Prefecture::class,
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
            new CustomerName,
            new PostCode,
            new Prefecture,
            new Address1,
            new Address2,
            new Note,
            new CreatedAt,
            new CreatedUser,
            new UpdatedAt,
            new UpdatedUser,
        ];
    }
}
