<?php

namespace App\ValueObjects\Column\Master\Administrator;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\ValueObject;
use Illuminate\Support\Facades\Route;

class Password extends ValueObject
{
    public const NAME = 'password';

    public const LABEL = 'パスワード';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'password';

    protected ?int $maxLength = 50;

    protected ?int $minLength = 1;

    protected bool $required = true; // DB Not Nullable

    public function rules(): array
    {
        $routeName = Route::currentRouteName();

        return match ($routeName) {
            // ルート名 => ルール
            'login.auth' => [
                'required',
                'string',
                "max:$this->maxLength",
                "min:$this->minLength",
            ],
            'me.save' => [
                // 更新時はIDは自動採番のため除外
                'nullable',
                'string',
                "max:$this->maxLength",
                "min:$this->minLength",
                'confirmed',
            ],
            'customers.store' => [
                // 新規登録時はIDは自動採番のため除外
            ],
            default => array_merge([
                // 通常時のバリデーション
                'string',
                "max:$this->maxLength",
                "min:$this->minLength",
                'confirmed',
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

    /**
     * 入力確認用フォーム
     */
    public function inputConfirm(array $attributes = []): string
    {
        $attributes['name'] = $this->name.'_confirmation';
        $attributes['id'] = $this->name.'_confirmation';
        $attributes['type'] = 'password';

        return CustomForm::make($this)
            ->label($attributes)
            ->input($attributes)
            ->render();
    }
}
