<?php

namespace App\ValueObjects\Column\System\EmailVerification;

use App\ValueObjects\Column\ColumnObject;

class Model extends ColumnObject
{
    public const NAME = 'model';

    public const LABEL = 'モデル名';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected bool $required = true; // DB Not Nullable

}
