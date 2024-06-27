<?php

namespace App\ValueObjects\User;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

class Name extends ValueObject
{
    public const NAME = 'name';

    public const LABEL = 'ユーザ名';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = 50;

    protected ?int $minLength = 1;

    protected bool $required = true; // DB Not Nullable

    public function rules(): array
    {
        $routeName = Route::currentRouteName();

        return match ($routeName) {
            'login.auth' => [
                'nullable',
            ],
            default => [
                // 通常時のバリデーション
                'required',
                'string',
                "max:$this->maxLength",
                "min:$this->minLength",
            ],
        };
    }

    /**
     * 入力項目を返す
     */
    public function input(array $attributes = []): View
    {
        $class = implode(' ', $attributes);

        return view('components.form.input', [
            'column' => $this,
            'attributes' => $attributes,
        ]);
    }
}
