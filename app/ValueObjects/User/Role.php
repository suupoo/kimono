<?php

namespace App\ValueObjects\User;

use App\Enums\UserRole;
use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;

class Role extends ValueObject
{
    public const NAME = 'role';

    public const LABEL = '権限';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'list';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = true;

    public function rules(): array
    {
        return [
            'required',
            'string',
            Rule::enum(UserRole::class),
        ];
    }

    public function options(): array
    {
        return UserRole::cases();
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
