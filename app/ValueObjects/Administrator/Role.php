<?php

namespace App\ValueObjects\Administrator;

use App\Enums\AdministratorRole;
use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
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
        $routeName = Route::currentRouteName();

        return match ($routeName) {
            'me.save' => [
                'nullable',
            ],
            default => [
                'required',
                'string',
                Rule::enum(AdministratorRole::class),
            ]
        };
    }

    public function options(): array
    {
        return AdministratorRole::casesExpectSystem();
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
