<?php

namespace App\Models;

use App\Enums\AdministratorRole;
use App\Facades\Utility\CustomStorage;
use App\ValueObjects\Column\Master\Administrator\CreatedAt;
use App\ValueObjects\Column\Master\Administrator\Email;
use App\ValueObjects\Column\Master\Administrator\EmailVerifiedAt;
use App\ValueObjects\Column\Master\Administrator\EndAt;
use App\ValueObjects\Column\Master\Administrator\Id;
use App\ValueObjects\Column\Master\Administrator\Image;
use App\ValueObjects\Column\Master\Administrator\Name;
use App\ValueObjects\Column\Master\Administrator\Password;
use App\ValueObjects\Column\Master\Administrator\RememberToken;
use App\ValueObjects\Column\Master\Administrator\Role;
use App\ValueObjects\Column\Master\Administrator\StartAt;
use App\ValueObjects\Column\Master\Administrator\UpdatedAt;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class MSystemAdministrator extends Authenticatable
{
    use HasFactory, Notifiable;

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
        StartAt::NAME => 'datetime',
        EndAt::NAME => 'datetime',
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
            'start_at' => 'datetime',
            'end_at' => 'datetime',
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
            new StartAt,
            new EndAt,
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

    /**
     * アクセサ：企業が設定されているかどうかを判定する
     *
     * @note $this->has_system_company で呼び出す
     */
    public function getHasSystemCompanyAttribute(): bool
    {
        return $this->systemCompanies->isNotEmpty();
    }

    /**
     * メール通知の送信先を取得する
     *
     * @param Notification $notification
     * @return array
     */
    public function routeNotificationForMail(Notification $notification): array
    {
        // 名前とメールアドレスを返す場合
        return [$this->email => $this->name];
    }
}
