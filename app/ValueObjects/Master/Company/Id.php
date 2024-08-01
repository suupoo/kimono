<?php

namespace App\ValueObjects\Master\Company;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class Id extends ValueObject
{
    public const NAME = 'id';

    public const LABEL = 'ID';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'integer';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = true; // DB Nullable

    protected bool $primaryKey = true;

    public function rules(): array
    {
        $routeName = Route::currentRouteName();

        return match ($routeName) {
            // ルート名 => ルール
            'system.companies.store' => [
                // 新規登録時はIDは自動採番のため除外
            ],
            'system.companies.update' => [
                // 新規登録時はIDは自動採番のため除外
                'integer',
                'required',
                Rule::unique('companies')->ignore(Route::current()->parameter('id')),
            ],
            default => array_merge([
                // 通常時のバリデーション
                'integer',
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
