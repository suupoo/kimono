<?php

namespace App\Models;

use App\Models\Scopes\OwnerScope;
use App\Models\Traits\ModelFillOwnerIdObservable;
use App\ValueObjects\Notification\Content;
use App\ValueObjects\Notification\CreatedAt;
use App\ValueObjects\Notification\CreatedUser;
use App\ValueObjects\Notification\Id;
use App\ValueObjects\Notification\OwnerSystemCompany;
use App\ValueObjects\Notification\PublishAt;
use App\ValueObjects\Notification\Status;
use App\ValueObjects\Notification\Title;
use App\ValueObjects\Notification\Type;
use App\ValueObjects\Notification\UpdatedAt;
use App\ValueObjects\Notification\UpdatedUser;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[ScopedBy([OwnerScope::class])]
class Notification extends BaseModel
{
    use HasFactory, ModelFillOwnerIdObservable;

    protected $table = 'notifications';

    const NAME = '通知';

    protected $casts = [
        Type::NAME  => \App\Enums\NotificationType::class,
        PublishAt::NAME => 'datetime',
        Status::NAME => \App\Enums\NotificationStatus::class,
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
            new Title,
            new Type,
            new Content,
            new PublishAt,
            new Status,
            new CreatedAt,
            new CreatedUser,
            new UpdatedAt,
            new UpdatedUser
        ];
    }
}
