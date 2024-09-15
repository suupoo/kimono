<?php

namespace App\ValueObjects\Column\System\Logging\AccessIpAddress;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use App\ValueObjects\Column\Master\Administrator\Id;

class MSystemAdministratorId extends Id
{
    public const NAME = 'm_system_administrator_id';

    public const LABEL = 'システム管理者ID';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'integer';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = true; // DB Nullable

    protected bool $primaryKey = true;
}
