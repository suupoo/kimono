<?php

namespace App\Models;

use App\ValueObjects\Column\System\Logging\AccessIpAddress\CreatedAt;
use App\ValueObjects\Column\System\Logging\AccessIpAddress\Uuid;
use App\ValueObjects\Column\System\Logging\AccessIpAddress\IpAddress;
use App\ValueObjects\Column\System\Logging\AccessIpAddress\MSystemAdministratorId;
use App\ValueObjects\Column\System\Logging\AccessIpAddress\UpdatedAt;
use App\ValueObjects\Column\System\Logging\AccessIpAddress\UserAgent;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SystemLoggingAccessIpAddress extends Model
{
    use HasUuids;

    protected $table = 'system_logging_access_ip_addresses';

    protected $primaryKey = Uuid::NAME;

    const NAME = 'アクセスログ（端末管理）';

    protected $casts = [
        CreatedAt::NAME => 'datetime',
        UpdatedAt::NAME => 'datetime',
    ];

    protected $guarded = [
        CreatedAt::NAME,
        UpdatedAt::NAME,
    ];

    public function mSystemAdministrator()
    {
        return $this->belongsTo(MSystemAdministrator::class);
    }

    /**
     * カラムを定義する関数
     */
    public static function getColumns(): array
    {
        return [
            new Uuid,
            new MSystemAdministratorId,
            new IpAddress,
            new UserAgent,
            new CreatedAt,
            new UpdatedAt,
        ];
    }
}
