<?php

namespace App\ValueObjects\Notification;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;

class PublishAt extends ValueObject
{
    public const NAME = 'publish_at';

    public const LABEL = '公開日時';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'datetime';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $required = false; // DB Nullable

    public function rules(): array
    {
        return [
            'nullable',
            'date',
        ];
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
