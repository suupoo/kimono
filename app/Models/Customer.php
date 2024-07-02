<?php

namespace App\Models;

use App\ValueObjects\Customer\Address1;
use App\ValueObjects\Customer\Address2;
use App\ValueObjects\Customer\CreatedAt;
use App\ValueObjects\Customer\CreatedUser;
use App\ValueObjects\Customer\CustomerName;
use App\ValueObjects\Customer\Id;
use App\ValueObjects\Customer\Note;
use App\ValueObjects\Customer\OwnedUser;
use App\ValueObjects\Customer\PostCode;
use App\ValueObjects\Customer\Prefecture;
use App\ValueObjects\Customer\UpdatedAt;
use App\ValueObjects\Customer\UpdatedUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends BaseModel
{
    use HasFactory;

    protected $table = 'customers';

    const NAME = '顧客';

    protected $casts = [
        Prefecture::NAME => \App\Enums\Prefecture::class,
    ];

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
            new CustomerName,
            new PostCode,
            new Prefecture,
            new Address1,
            new Address2,
            new Note,
            new OwnedUser,
            new CreatedAt,
            new CreatedUser,
            new UpdatedAt,
            new UpdatedUser,
        ];
    }
}
