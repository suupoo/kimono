<?php

namespace App\Models;

use App\ValueObjects\Company\CreatedAt;
use App\ValueObjects\Company\Id;
use App\ValueObjects\Company\Name;
use App\ValueObjects\Company\UpdatedAt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    const NAME = '企業';

    protected $casts = [];
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
            new CreatedAt,
            new UpdatedAt,
        ];
    }
}
