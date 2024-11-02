<?php

namespace App\ValueObjects\Column\Master\Holiday;

use App\ValueObjects\Column\ColumnObject;

class Name extends ColumnObject
{
    public const NAME = 'name';

    public const LABEL = '祝日名';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = 255;

    protected ?int $minLength = null;

    protected bool $required = true; // DB Nullable

    protected string $placeholder = self::LABEL;
}
