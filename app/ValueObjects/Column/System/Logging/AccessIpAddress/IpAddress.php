<?php

namespace App\ValueObjects\Column\System\Logging\AccessIpAddress;

use App\ValueObjects\Column\ColumnObject;

class IpAddress extends ColumnObject
{
    public const NAME = 'ip_address';

    public const LABEL = 'IPアドレス';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = false; // DB Nullable
}
