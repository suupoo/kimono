<?php

namespace App\ValueObjects\Column\System\Logging\AccessIpAddress;

use App\ValueObjects\Column\ColumnObject;

class Uuid extends ColumnObject
{
    public const NAME = 'uuid';

    public const LABEL = 'UUID';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = true; // DB Nullable

    protected bool $primaryKey = true;
}
