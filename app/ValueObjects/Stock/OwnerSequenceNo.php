<?php

namespace App\ValueObjects\Stock;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;

class OwnerSequenceNo extends ValueObject
{
    public const NAME = 'owner_sequence_no';

    public const LABEL = 'No.';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'string';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = false; // DB Nullable

    protected bool $primaryKey = false;
    protected bool $unique = true;

    public function rules(): array
    {
        return [
            'string',
            'nullable',
        ];
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
