<?php

namespace App\ValueObjects\Column\Master\Company;

use App\ValueObjects\ValueObject;

class UpdatedAt extends ValueObject
{
    public const NAME = 'updated_at';

    public const LABEL = '更新日時';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'datetime';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = false; // DB Nullable

    public function rules(): array
    {
        return [
            'nullable',
            'date',
        ];
    }
}
