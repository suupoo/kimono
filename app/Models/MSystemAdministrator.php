<?php

namespace App\Models;

use App\Enums\AdministratorRole;
use App\ValueObjects\Administrator\CreatedAt;
use App\ValueObjects\Administrator\Email;
use App\ValueObjects\Administrator\EmailVerifiedAt;
use App\ValueObjects\Administrator\Id;
use App\ValueObjects\Administrator\Name;
use App\ValueObjects\Administrator\Password;
use App\ValueObjects\Administrator\RememberToken;
use App\ValueObjects\Administrator\UpdatedAt;
use App\ValueObjects\Administrator\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MSystemAdministrator extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_system_administrators';

    const NAME = 'システム管理者';

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
        Role::NAME => AdministratorRole::class,
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
            new Role,
            new RememberToken,
            new CreatedAt,
            new UpdatedAt,
        ];
    }
}
