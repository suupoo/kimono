<?php

namespace App\ValueObjects\Customer;

use App\Enums\Prefecture as PrefectureEnum;
use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;

class Prefecture extends ValueObject
{
    public const NAME = 'prefecture';

    public const LABEL = '都道府県';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'list';

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
     */
    public function input(array $attributes = []): View
    {
        $class = implode(' ', $attributes);

        return view('components.form.select', [
            'column' => $this,
            'attributes' => $attributes,
        ]);
    }
}
