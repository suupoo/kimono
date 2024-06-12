<?php

namespace App\ValueObjects\Customer;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;
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

    /**
     * 入力項目を返す
     * @param array $attributes
     * @return View
     */
    public function input(array $attributes = [])
    {
        $class = implode(' ', $attributes);
        return view('components.form.select', [
            'column' => $this,
            'attributes'  => $attributes,
        ]);
    }
}
