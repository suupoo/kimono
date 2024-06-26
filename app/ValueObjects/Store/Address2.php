<?php

namespace App\ValueObjects\Store;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;

class Address2 extends ValueObject
{
    public const NAME = 'address_2';

    public const LABEL = '住所２';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = 255;

    protected ?int $minLength = null;

    protected bool $required = false; // DB Nullable

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
    public function input(array $attributes = []): View
    {
        $class = implode(' ', $attributes);

        return view('components.form.input', [
            'column' => $this,
            'attributes' => $attributes,
        ]);
    }
}
