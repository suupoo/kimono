<?php

namespace App\Models;

use App\Models\Scopes\OwnerScope;
use App\Models\Traits\ModelFillOwnerIdObservable;
use App\ValueObjects\Column\Notification\Content;
use App\ValueObjects\Column\Notification\CreatedAt;
use App\ValueObjects\Column\Notification\CreatedUser;
use App\ValueObjects\Column\Notification\DeletedAt;
use App\ValueObjects\Column\Notification\Id;
use App\ValueObjects\Column\Notification\OwnerSequenceNo;
use App\ValueObjects\Column\Notification\OwnerSystemCompany;
use App\ValueObjects\Column\Notification\PublishAt;
use App\ValueObjects\Column\Notification\Status;
use App\ValueObjects\Column\Notification\Tags;
use App\ValueObjects\Column\Notification\Title;
use App\ValueObjects\Column\Notification\Type;
use App\ValueObjects\Column\Notification\UpdatedAt;
use App\ValueObjects\Column\Notification\UpdatedUser;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ScopedBy([OwnerScope::class])]
class Notification extends BaseModel
{
    use HasFactory, ModelFillOwnerIdObservable, SoftDeletes;

    protected $table = 'notifications';

    const NAME = '通知';

    protected $casts = [
        Type::NAME => \App\Enums\NotificationType::class,
        PublishAt::NAME => 'datetime',
        Status::NAME => \App\Enums\NotificationStatus::class,
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
            new Title,
            new Type,
            new Content,
            new PublishAt,
            new Status,
            new Tags,
            new CreatedAt,
            new CreatedUser,
            new UpdatedAt,
            new UpdatedUser,
            new DeletedAt,
        ];
    }
}
