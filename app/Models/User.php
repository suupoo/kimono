<?php

namespace App\Models;

use App\Models\Traits\ModelFillOwnerIdObservable;
use App\ValueObjects\User\CreatedAt;
use App\ValueObjects\User\Email;
use App\ValueObjects\User\EmailVerifiedAt;
use App\ValueObjects\User\Id;
use App\ValueObjects\User\Name;
use App\ValueObjects\User\OwnerSystemCompany;
use App\ValueObjects\User\Password;
use App\ValueObjects\User\RememberToken;
use App\ValueObjects\User\UpdatedAt;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Scopes\OwnerScope;

#[ScopedBy([OwnerScope::class])]
class User extends BaseModel
{
    use HasFactory, ModelFillOwnerIdObservable;

    protected $table = 'users';

    const NAME = 'ユーザー';

    protected $guarded = [
        'id',
        'owner_system_company',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * カラムを定義する関数
     */
    public static function getColumns(): array
    {
        return [
            new Id,
            new OwnerSystemCompany,
            new Name,
            new Email,
            new EmailVerifiedAt,
            new Password,
            new RememberToken,
            new CreatedAt,
            new UpdatedAt,
        ];
    }
}
