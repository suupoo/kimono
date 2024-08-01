<?php

namespace App\ValueObjects\Staff;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class Code extends ValueObject
{
    public const NAME = 'code';

    public const LABEL = 'スタッフコード';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = false; // DB Nullable

    protected bool $primaryKey = false;

    public function rules(): array
    {
        $routeName = Route::currentRouteName();
        $id = Route::current()->parameter('id');

        return match ($routeName) {
            // ルート名 => ルール
            'staffs.update' => [
                // 更新時はIDは自動採番のため除外
                'nullable',
                'string',
                Rule::unique('staffs')->ignore($id),
            ],
            default => array_merge([
                // 通常時のバリデーション
                'nullable',
                'string',
                Rule::unique('staffs'),
            ]),
        };
    }

    /**
     * 入力項目を返す
     */
    public function input(array $attributes = []): View
    {
        return view('components.form.input', [
            'column' => $this,
            'attributes' => $attributes,
        ]);
    }
}
