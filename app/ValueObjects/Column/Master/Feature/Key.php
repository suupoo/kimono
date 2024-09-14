<?php

namespace App\ValueObjects\Column\Master\Feature;

use App\ValueObjects\Column\ColumnObject;

class Key extends ColumnObject
{
    public const NAME = 'key';

    public const LABEL = '機能キー';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = true; // DB Nullable

    protected bool $primaryKey = true;
}
