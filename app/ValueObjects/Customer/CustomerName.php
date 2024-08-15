<?php

namespace App\ValueObjects\Customer;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\ValueObject;

class CustomerName extends ValueObject
{
    public const NAME = 'customer_name';

    public const LABEL = '顧客名';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = 255;

    protected ?int $minLength = 1;

    protected bool $required = true; // DB Not Nullable

    protected ?string $placeholder = '株式会社〇〇';

    public function rules(): array
    {
        return [
            'required',
            'string',
            "max:$this->maxLength",
            "min:$this->minLength",
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
