<?php

namespace App\ValueObjects\Stock;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;

class Name extends ValueObject
{
    public const NAME = 'name';

    public const LABEL = '商品名';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = 255;

    protected ?int $minLength = 1;

    protected bool $required = true; // DB Not Nullable

    protected string $placeholder = '商品名';

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
    public function input(array $attributes = []): View
    {
        $attributes['placeholder'] = $this->placeholder;

        return view('components.form.input', [
            'column' => $this,
            'attributes' => $attributes,
        ]);
    }
}
