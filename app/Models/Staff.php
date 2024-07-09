<?php

namespace App\Models;

use App\ValueObjects\Staff\Code;
use App\ValueObjects\Staff\CreatedAt;
use App\ValueObjects\Staff\CreatedUser;
use App\ValueObjects\Staff\Id;
use App\ValueObjects\Staff\JoinDate;
use App\ValueObjects\Staff\Name;
use App\ValueObjects\Staff\QuitDate;
use App\ValueObjects\Staff\Tel;
use App\ValueObjects\Staff\UpdatedAt;
use App\ValueObjects\Staff\UpdatedUser;
use App\ValueObjects\Staff\StaffPosition;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends BaseModel
{
    use HasFactory;

    protected $table = 'staffs';

    const NAME = 'スタッフ';

    protected $casts = [
        StaffPosition::NAME => \App\Enums\StaffPosition::class,
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
            new Tel,
            new StaffPosition,
            new JoinDate,
            new QuitDate,
            new CreatedAt,
            new CreatedUser,
            new UpdatedAt,
            new UpdatedUser,
        ];
    }
}
