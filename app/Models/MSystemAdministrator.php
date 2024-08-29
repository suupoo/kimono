<?php

namespace App\Models;

use App\Enums\AdministratorRole;
use App\Facades\Utility\CustomStorage;
use App\ValueObjects\Master\Administrator\CreatedAt;
use App\ValueObjects\Master\Administrator\Email;
use App\ValueObjects\Master\Administrator\EmailVerifiedAt;
use App\ValueObjects\Master\Administrator\Id;
use App\ValueObjects\Master\Administrator\Image;
use App\ValueObjects\Master\Administrator\Name;
use App\ValueObjects\Master\Administrator\Password;
use App\ValueObjects\Master\Administrator\RememberToken;
use App\ValueObjects\Master\Administrator\Role;
use App\ValueObjects\Master\Administrator\UpdatedAt;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
            'role' => AdministratorRole::class,
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
            new Image,
            new Password,
            new Role,
            new RememberToken,
            new CreatedAt,
            new UpdatedAt,
        ];
    }

    /**
     * システム企業
     */
    public function systemCompanies(): BelongsToMany
    {
        return $this->belongsToMany(
            MSystemCompany::class,
            'm_system_administrator_companies',
            'system_administrator',
            'system_company',
        );
    }

    /**
     * アクセサ：システム管理者かどうかを判定する
     *
     * @note $this->is_system で呼び出す
     */
    public function isSystem()
    {
        return $this->role === AdministratorRole::SYSTEM;
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
