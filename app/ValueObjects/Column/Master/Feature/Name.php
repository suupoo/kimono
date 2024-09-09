<?php

namespace App\ValueObjects\Column\Master\Feature;

use App\ValueObjects\ValueObject;

class Name extends ValueObject
{
    public const NAME = 'name';

    public const LABEL = '機能名';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = true; // DB Nullable

    protected string $placeholder = '機能名';
}
