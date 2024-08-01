<?php

namespace App\ValueObjects\Staff;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;

class Tel extends ValueObject
{
    public const NAME = 'tel';

    public const LABEL = '電話番号';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = 11;

    protected ?int $minLength = 10;

    protected bool $required = false; // DB Nullable

    protected string $placeholder = '08011112222';

    public function rules(): array
    {
        return [
            'nullable',
            'string',
            "max:$this->maxLength",
            "min:$this->minLength",
            'regex:/^[0-9]{'.$this->minLength.','.$this->maxLength.'}$/',
        ];
    }

    /**
     * 入力項目を返す
     */
    public function input(array $attributes = []): View
    {
        // プレースホルダを設定
        $attributes['placeholder'] = $this->placeholder;

        return view('components.form.input', [
            'column' => $this,
            'attributes' => $attributes,
        ]);
    }
}
