<?php

namespace App\ValueObjects\Master\Company;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

class Uuid extends ValueObject
{
    public const NAME = 'uuid';

    public const LABEL = 'uuid';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = true; // DB Nullable

    protected bool $primaryKey = false;

    protected bool $unique = true;

    public function rules(): array
    {
        $routeName = Route::currentRouteName();

        return match ($routeName) {
            // ルート名 => ルール
            default => array_merge([
                // 通常時のバリデーション
                'nullable',
                'string',
                'uuid',
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
