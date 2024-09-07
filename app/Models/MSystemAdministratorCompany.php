<?php

namespace App\Models;

use App\ValueObjects\Master\AdministratorCompany\Id;
use App\ValueObjects\Master\AdministratorCompany\SystemAdministratorId;
use App\ValueObjects\Master\AdministratorCompany\SystemCompanyId;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MSystemAdministratorCompany extends BaseModel
{
    use HasFactory;

    protected $table = 'm_system_administrator_companies';

    const NAME = 'システム管理者企業';

    public $timestamps = false;

    protected $authors = false;

    protected $casts = [];

    protected $guarded = [];

    /**
     * カラムを定義する関数
     */
    public static function getColumns(): array
    {
        return [
            new Id,
            new SystemAdministratorId,
            new SystemCompanyId,
        ];
    }

    public function systemAdministrators()
    {
        return $this->belongsTo(MSystemAdministrator::class);
    }

    public function systemCompanies()
    {
        return $this->belongsTo(MSystemCompany::class);
    }
}
