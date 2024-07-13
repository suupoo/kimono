<?php

namespace App\ValueObjects\M_Function;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;

class Enable extends ValueObject
{
    public const NAME = 'enable';

    public const LABEL = '有効フラグ';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'bool';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = true; // DB Nullable

}
