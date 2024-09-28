<?php

namespace App\ValueObjects\Column\Master\CompanyDashboard;

use App\ValueObjects\Column\Master\AdministratorCompany\Id;

class MSystemCompanyId extends Id
{
    public const NAME = 'm_system_company_id';

    public const LABEL = '企業ID';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'integer';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = true; // DB Nullable

    protected bool $primaryKey = false;
}
