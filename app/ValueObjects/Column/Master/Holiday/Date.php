<?php

namespace App\ValueObjects\Column\Master\Holiday;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\Column\ColumnObject;

class Date extends ColumnObject
{
    public const NAME = 'date';

    public const LABEL = '日付';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'date';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected ?int $min = null;

    protected ?int $max = null;

    protected string $placeholder = '2021-01-01';

    protected bool $required = true; // DB Nullable

    public function rules(): array
    {
        return [
            'nullable',
            'date',
        ];
    }

    /**
     * 入力項目を返す
     */
    public function input(array $attributes = []): string
    {
        return CustomForm::make($this)
            ->label($attributes)
            ->input($attributes)
            ->render();
    }
}
