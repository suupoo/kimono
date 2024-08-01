<?php

namespace App\ValueObjects\Staff;

use App\Enums\StaffPosition as StaffPositionEnum;
use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;

class StaffPosition extends ValueObject
{
    public const NAME = 'position';

    public const LABEL = '役職';

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
            'required',
            'string',
            Rule::enum(StaffPositionEnum::class),
        ];
    }

    public function options(): array
    {
        return StaffPositionEnum::cases();
    }

    /**
     * 入力項目を返す
     */
    public function input(array $attributes = []): View
    {
        return view('components.form.select', [
            'column' => $this,
            'attributes' => $attributes,
        ]);
    }
}
