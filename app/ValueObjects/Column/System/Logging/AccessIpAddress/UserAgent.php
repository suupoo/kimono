<?php

namespace App\ValueObjects\Column\System\Logging\AccessIpAddress;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\Column\ColumnObject;

class UserAgent extends ColumnObject
{
    public const NAME = 'user_agent';

    public const LABEL = 'ユーザーエージェント';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = false; // DB Nullable
}
