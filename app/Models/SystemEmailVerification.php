<?php

namespace App\Models;

use App\ValueObjects\Column\System\EmailVerification\CreatedAt;
use App\ValueObjects\Column\System\EmailVerification\Email;
use App\ValueObjects\Column\System\EmailVerification\ExpiredAt;
use App\ValueObjects\Column\System\EmailVerification\Id;
use App\ValueObjects\Column\System\EmailVerification\ModelsId;
use App\ValueObjects\Column\System\EmailVerification\Model as ModelColumn;
use App\ValueObjects\Column\System\EmailVerification\Token;
use App\ValueObjects\Column\System\EmailVerification\Uuid;
use Illuminate\Database\Eloquent\Model;

class SystemEmailVerification extends Model
{
    protected $table = 'system_email_verifications';

    public $timestamps = false;

    const NAME = 'メール認証';

    protected $casts = [
        'created_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    protected $guarded = [
        'id',
    ];

    /**
     * カラムを定義する関数
     */
    public static function getColumns(): array
    {
        return [
            new Id,
            new ModelColumn,
            new ModelsId,
            new Email,
            new Token,
            new CreatedAt,
            new ExpiredAt,
        ];
    }
}
