<?php

namespace App\ValueObjects\Administrator;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;
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
            'users.update' => [
                // 更新時はIDは自動採番のため除外
                'nullable',
                'string',
                "max:$this->maxLength",
                "min:$this->minLength",
                'confirmed',
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
    public function input(array $attributes = []): View
    {
        $class = implode(' ', $attributes);

        return view('components.form.input', [
            'column' => $this,
            'attributes' => $attributes,
        ]);
    }

    /**
     * 入力確認用フォーム
     */
    public function inputConfirm(array $attributes = []): View
    {
        return view('components.form.confirm', [
            'column' => $this,
            'attributes' => $attributes,
        ]);
    }
}
