<?php

namespace App\Models;

use App\Enums\UserRole;
use App\ValueObjects\User\CreatedAt;
use App\ValueObjects\User\Email;
use App\ValueObjects\User\EmailVerifiedAt;
use App\ValueObjects\User\Id;
use App\ValueObjects\User\Name;
use App\ValueObjects\User\Password;
use App\ValueObjects\User\RememberToken;
use App\ValueObjects\User\Role;
use App\ValueObjects\User\UpdatedAt;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    const NAME = 'ユーザ';

    protected $guarded = [
        'id',
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

    protected $casts = [
        Role::NAME => UserRole::class,
    ];

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
            new Name,
            new Email,
            new EmailVerifiedAt,
            new Password,
            new RememberToken,
            new Role,
            new CreatedAt,
            new UpdatedAt,
        ];
    }
}
