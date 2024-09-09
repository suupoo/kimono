<?php

namespace App\Models;

use App\ValueObjects\Column\Master\Company\CreatedAt;
use App\ValueObjects\Column\Master\Company\Id;
use App\ValueObjects\Column\Master\Company\Name;
use App\ValueObjects\Column\Master\Company\UpdatedAt;
use App\ValueObjects\Column\Master\Company\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MSystemCompany extends Model
{
    use HasFactory;

    protected $table = 'm_system_companies';

    const NAME = 'システム企業';

    protected $casts = [
        'conoha_tenant_password' => 'encrypted',
        'conoha_tenant_id' => 'encrypted',
        'conoha_tenant_temporary_url_key' => 'encrypted',
    ];

    protected $guarded = [
        'id',
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
            new Name,
            new Uuid,
            new CreatedAt,
            new UpdatedAt,
        ];
    }
}
