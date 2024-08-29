<?php

namespace App\ValueObjects\User;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\ValueObject;
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

    protected string $placeholder = 'ユーザ名';

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
    public function input(array $attributes = []): string
    {
        return CustomForm::make($this)
            ->label($attributes)
            ->input($attributes)
            ->render();
    }
}
