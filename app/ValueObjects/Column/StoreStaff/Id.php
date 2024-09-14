<?php

namespace App\ValueObjects\Column\StoreStaff;

use App\ValueObjects\Column\ColumnObject;

class Id extends ColumnObject
{
    public const NAME = 'id';

    public const LABEL = 'ID';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'integer';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = true; // DB Nullable

    protected bool $primaryKey = true;
}
