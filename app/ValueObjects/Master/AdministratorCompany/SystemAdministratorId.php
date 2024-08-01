<?php

namespace App\ValueObjects\Master\AdministratorCompany;

use App\ValueObjects\Master\Administrator\Id as OriginalAdministratorId;

class SystemAdministratorId extends OriginalAdministratorId
{
    public const NAME = 'system_administrator';

    public const LABEL = 'SYSTEM_ADMINISTRATOR';

    protected bool $primaryKey = false;
}
