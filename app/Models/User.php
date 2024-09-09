<?php

namespace App\Models;

use App\Models\Scopes\OwnerScope;
use App\Models\Traits\ModelFillOwnerIdObservable;
use App\ValueObjects\Column\User\CreatedAt;
use App\ValueObjects\Column\User\CreatedUser;
use App\ValueObjects\Column\User\DeletedAt;
use App\ValueObjects\Column\User\Email;
use App\ValueObjects\Column\User\EmailVerifiedAt;
use App\ValueObjects\Column\User\Id;
use App\ValueObjects\Column\User\Name;
use App\ValueObjects\Column\User\OwnerSequenceNo;
use App\ValueObjects\Column\User\OwnerSystemCompany;
use App\ValueObjects\Column\User\Password;
use App\ValueObjects\Column\User\RememberToken;
use App\ValueObjects\Column\User\Tags;
use App\ValueObjects\Column\User\UpdatedAt;
use App\ValueObjects\Column\User\UpdatedUser;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ScopedBy([OwnerScope::class])]
class User extends BaseModel
{
    use HasFactory, ModelFillOwnerIdObservable, SoftDeletes;

    protected $table = 'users';

    const NAME = 'ユーザー';

    protected $guarded = [
        'id',
        'owner_sequence_no',
        'owner_system_company',
        'created_at',
        'updated_at',
        'deleted_at',
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
            new OwnerSequenceNo,
            new OwnerSystemCompany,
            new Name,
            new Email,
            new EmailVerifiedAt,
            new Password,
            new RememberToken,
            new Tags,
            new CreatedAt,
            new CreatedUser,
            new UpdatedAt,
            new UpdatedUser,
            new DeletedAt,
        ];
    }
}
