<?php

namespace App\ValueObjects\Column\Staff;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\Column\ColumnObject;

class JoinDate extends ColumnObject
{
    public const NAME = 'join_date';

    public const LABEL = '入社日';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'date';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected string $placeholder = '2021-01-01';

    protected bool $required = false; // DB Nullable

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
