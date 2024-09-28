<?php

namespace App\Models;

use App\ValueObjects\Column\Master\CompanyDashboard\CreatedAt;
use App\ValueObjects\Column\Master\CompanyDashboard\Dashboard;
use App\ValueObjects\Column\Master\CompanyDashboard\MSystemCompanyId;
use App\ValueObjects\Column\Master\CompanyDashboard\UpdatedAt;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

class MSystemCompanyDashboard extends Model
{
    protected $table = 'm_system_company_dashboards';

    const NAME = 'システム企業ダッシュボード';


    protected $primaryKey = MSystemCompanyId::NAME;

    protected $guarded = [
        CreatedAt::NAME,
        UpdatedAt::NAME,
    ];

    protected $casts = [
        Dashboard::NAME => CleanHtml::class,
    ];

    /**
     * カラムを定義する関数
     */
    public static function getColumns(): array
    {
        return [
            new MSystemCompanyId,
            new Dashboard,
            new CreatedAt,
            new UpdatedAt,
        ];
    }

    /**
     * システム企業情報
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(MSystemCompany::class, 'm_system_company_id', 'id');
    }
}
