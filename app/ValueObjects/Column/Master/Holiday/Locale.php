<?php

namespace App\ValueObjects\Column\Master\Holiday;

use App\ValueObjects\Column\ColumnObject;

class Locale extends ColumnObject
{
    public const NAME = 'locale';

    public const LABEL = 'ロケール';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = 5;

    protected ?int $minLength = 5;

    protected bool $required = true; // DB Nullable

    protected string $placeholder = self::LABEL;
}
