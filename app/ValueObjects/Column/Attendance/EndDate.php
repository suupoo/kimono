<?php

namespace App\ValueObjects\Column\Attendance;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\Column\ColumnObject;

class EndDate extends ColumnObject
{
    public const NAME = 'end_date';

    public const LABEL = '終了日';

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
            'required',
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
