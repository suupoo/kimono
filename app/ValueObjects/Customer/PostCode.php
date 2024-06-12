<?php

namespace App\ValueObjects\Customer;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;

class PostCode extends ValueObject
{
    protected string $name = 'post_code';
    protected string $columnName = 'post_code';
    protected string $label = '郵便番号';
    protected string $type =  'string';
    protected ?int $maxLength = 8;
    protected ?int $minLength = 8;
    protected bool $required = false; // DB Nullable

    public function rules(): array
    {
        return [
            'nullable',
            'string',
            "max:$this->maxLength",
            "min:$this->minLength",
            "regex:/^[0-9]{3}-[0-9]{4}$/"
        ];
    }

    /**
     * 入力項目を返す
     * @param array $attributes
     * @return View
     */
    public function input(array $attributes = [])
    {
        $class = implode(' ', $attributes);
        return view('components.form.input', [
            'column' => $this,
            'attributes'  => $attributes,
        ]);
    }
}
