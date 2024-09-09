<?php

namespace App\ValueObjects\Column\Master\Feature;

use App\ValueObjects\ValueObject;

class FlagSwitch extends ValueObject
{
    public const NAME = 'flag_switch';

    public const LABEL = '切替可能フラグ';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'bool';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = false; // DB Nullable
}
