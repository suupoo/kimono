<?php

namespace App\ValueObjects\Column\Store;

use App\ValueObjects\Column\ColumnObject;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class Id extends ColumnObject
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
            'stores.store' => [
                // 新規登録時はIDは自動採番のため除外
            ],
            'stores.update' => [
                // 新規登録時はIDは自動採番のため除外
                'integer',
                'required',
                Rule::unique('stores')->ignore(Route::current()->parameter('id')),
            ],
            default => array_merge([
                // 通常時のバリデーション
                'integer',
            ]),
        };
    }
}
