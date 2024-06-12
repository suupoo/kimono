<?php

namespace App\ValueObjects\Customer;

use App\ValueObjects\ValueObject;
use Illuminate\Validation\Rule;
use App\Enums\Prefecture as PrefectureEnum;

class Prefecture extends ValueObject
{
    protected string $name = 'prefecture';
    protected string $columnName = 'prefecture';
    protected string $label = '都道府県';
    protected string $type =  'list';
    protected ?int $maxLength = null;
    protected ?int $minLength = null;
    protected bool $required = false;

    public function rules(): array
    {
        return [
            'nullable',
            'string',
            Rule::enum(PrefectureEnum::class),
        ];
    }

    public function options(): array
    {
        return PrefectureEnum::cases();
    }
}
