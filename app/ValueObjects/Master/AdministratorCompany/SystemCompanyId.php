<?php

namespace App\ValueObjects\Master\AdministratorCompany;

use App\ValueObjects\Master\Company\Id as OriginalCompanyId;

class SystemCompanyId extends OriginalCompanyId
{
    public const NAME = 'system_company';

    public const LABEL = 'SYSTEM_COMPANY';

    protected bool $primaryKey = false;
}
