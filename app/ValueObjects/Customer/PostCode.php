<?php

namespace App\ValueObjects\Customer;

use App\ValueObjects\ValueObject;

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
}
