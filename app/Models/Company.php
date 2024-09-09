<?php

namespace App\Models;

use App\Models\Scopes\OwnerScope;
use App\Models\Traits\ModelFillOwnerIdObservable;
use App\ValueObjects\Column\Company\CreatedAt;
use App\ValueObjects\Column\Company\CreatedUser;
use App\ValueObjects\Column\Company\DeletedAt;
use App\ValueObjects\Column\Company\Id;
use App\ValueObjects\Column\Company\Name;
use App\ValueObjects\Column\Company\OwnerSequenceNo;
use App\ValueObjects\Column\Company\OwnerSystemCompany;
use App\ValueObjects\Column\Company\Tags;
use App\ValueObjects\Column\Company\UpdatedAt;
use App\ValueObjects\Column\Company\UpdatedUser;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ScopedBy([OwnerScope::class])]
class Company extends BaseModel
{
    use HasFactory, ModelFillOwnerIdObservable, SoftDeletes;

    protected $table = 'companies';

    const NAME = '企業';

    protected $casts = [];

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
            new Name,
            new Tags,
            new CreatedAt,
            new CreatedUser,
            new UpdatedAt,
            new UpdatedUser,
            new DeletedAt,
        ];
    }
}
