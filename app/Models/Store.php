<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\ValueObjects\Store\Name;
use App\ValueObjects\Store\Address1;
use App\ValueObjects\Store\Address2;
use App\ValueObjects\Store\CreatedAt;
use App\ValueObjects\Store\Id;
use App\ValueObjects\Store\PostCode;
use App\ValueObjects\Store\Prefecture;
use App\ValueObjects\Store\UpdatedAt;
use App\ValueObjects\Store\Code;


class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';

    const NAME = '店舗';

    protected $casts = [
        Prefecture::NAME => \App\Enums\Prefecture::class,
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
            new Code,
            new PostCode,
            new Prefecture,
            new Address1,
            new Address2,
            new CreatedAt,
            new UpdatedAt,
        ];
    }
}
