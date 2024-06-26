<?php

namespace App\ValueObjects\Store;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class Code extends ValueObject
{
    public const NAME = 'code';

    public const LABEL = '店舗コード';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = true; // DB Nullable

    protected bool $primaryKey = true;

    public function rules(): array
    {
        $routeName = Route::currentRouteName();
        $code = Route::current()->parameter('code');

        return match ($routeName) {
            // ルート名 => ルール
            'stores.update' => [
                // 更新時はIDは自動採番のため除外
                'required',
                'string',
                Rule::unique('stores')->ignore($code),
            ],
            default => array_merge([
                // 通常時のバリデーション
                'required',
                'string',
                Rule::unique('stores'),
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
}
