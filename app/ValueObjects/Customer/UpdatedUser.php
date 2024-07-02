<?php

namespace App\ValueObjects\Customer;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;

class UpdatedUser extends ValueObject
{
    public const NAME = 'updated_user';

    public const LABEL = '更新者';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'number';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = false; // DB Nullable

    public function rules(): array
    {
        return [
            'integer',
            'exists:users,id',
        ];
    }

    /**
     * 入力項目を返す
     */
    public function input(array $attributes = []): View
    {
        // 作成者は自動採番のため入力には対応しない
        return view('components.form.empty');
    }
}
