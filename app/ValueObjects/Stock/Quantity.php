<?php

namespace App\ValueObjects\Stock;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\ValueObject;

class Quantity extends ValueObject
{
    public const NAME = 'quantity';

    public const LABEL = '在庫数';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'integer';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected ?int $min = 0;

    protected ?int $max = 999;

    protected bool $required = false;

    public function rules(): array
    {
        return [
            'required',
            'numeric',
            "min:$this->min",
            "max:$this->max",
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
