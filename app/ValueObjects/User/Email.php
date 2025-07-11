<?php

namespace App\ValueObjects\User;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\ValueObject;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class Email extends ValueObject
{
    public const NAME = 'email';

    public const LABEL = 'メールアドレス';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'email';

    protected ?int $maxLength = 50;

    protected ?int $minLength = 1;

    protected bool $required = true; // DB Not Nullable

    protected string $placeholder = 'mail@example.com';

    public function rules(): array
    {
        $routeName = Route::currentRouteName();

        return match ($routeName) {
            'users.update' => [
                'required',
                'email',
                "max:$this->maxLength",
                "min:$this->minLength",
                Rule::unique('users')->ignore(Route::current()->parameter('id')),
            ],
            default => array_merge([
                // 通常時のバリデーション
                'required',
                'email',
                "max:$this->maxLength",
                "min:$this->minLength",
                'unique:users,email',
            ]),
        };
    }

    /**
     * 入力項目を返す
     */
    public function input(array $attributes = []): string
    {
        return CustomForm::make($this)
            ->label($attributes)
            ->input($attributes)
            ->render();
    }
}
