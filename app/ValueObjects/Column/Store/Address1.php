<?php

namespace App\ValueObjects\Column\Store;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\Column\ColumnObject;

class Address1 extends ColumnObject
{
    public const NAME = 'address_1';

    public const LABEL = '住所１';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = 255;

    protected ?int $minLength = null;

    protected bool $required = false; // DB Nullable

    protected string $placeholder = '大阪府高槻市桃園町２番１号';

    public function rules(): array
    {
        return [
            'nullable',
            'string',
            "max:$this->maxLength",
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
