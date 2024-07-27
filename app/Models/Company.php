<?php

namespace App\Models;

use App\Models\Scopes\OwnerScope;
use App\Models\Traits\ModelFillOwnerIdObservable;
use App\ValueObjects\Company\CreatedAt;
use App\ValueObjects\Company\Id;
use App\ValueObjects\Company\Name;
use App\ValueObjects\Company\OwnerSystemCompany;
use App\ValueObjects\Company\UpdatedAt;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ScopedBy([OwnerScope::class])]
class Company extends Model
{
    use HasFactory, ModelFillOwnerIdObservable;

    protected $table = 'companies';

    const NAME = '企業';

    protected $casts = [];
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
            new Name,
            new CreatedAt,
            new UpdatedAt,
        ];
    }
}
