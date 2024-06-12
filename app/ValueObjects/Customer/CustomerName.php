<?php

namespace App\ValueObjects\Customer;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;

class CustomerName extends ValueObject
{
    protected string $name = 'customer_name';
    protected string $columnName = 'customer_name';
    protected string $label = '顧客名';
    protected string $type =  'string';
    protected ?int $maxLength = 3;
    protected ?int $minLength = 1;
    protected bool $required = true; // DB Not Nullable

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
