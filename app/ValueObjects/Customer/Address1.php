<?php

namespace App\ValueObjects\Customer;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;

class Address1 extends ValueObject
{
    protected string $name = 'address_1';
    protected string $columnName = 'address_1';
    protected string $label = '住所１';
    protected string $type =  'string';
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
