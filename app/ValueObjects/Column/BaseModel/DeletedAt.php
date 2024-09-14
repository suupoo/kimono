<?php

namespace App\ValueObjects\Column\BaseModel;

use App\ValueObjects\Column\ColumnObject;

class DeletedAt extends ColumnObject
{
    public const NAME = 'deleted_at';

    public const LABEL = '削除日時';

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
