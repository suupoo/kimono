<?php

namespace App\Models\ColumnEnum;

enum User: string
{
    case TABLE_NAME = 'ユーザー';
    case ID = 'id';
    case NAME = 'name';
    case EMAIL = 'email';
    case EMAIL_VERIFIED_AT = 'email_verified_at';
    case PASSWORD = 'password';
    case REMEMBER_TOKEN = 'remember_token';
    case CREATED_AT = 'created_at';
    case UPDATED_AT = 'updated_at';

    /**
     * @return string カラムの入力タイプ
     */
    public function inputType(): string
    {
        return match ($this) {
            self::ID => 'number',
            self::NAME => 'text',
            self::EMAIL => 'email',
            self::EMAIL_VERIFIED_AT => 'datetime-local',
            self::PASSWORD => 'password',
            self::REMEMBER_TOKEN => 'text',
            self::CREATED_AT => 'datetime-local',
            self::UPDATED_AT => 'datetime-local',
            default => throw new \Exception('Invalid column'),
        };
    }

    /**
     * カラムの表示名
     */
    public function label(): string
    {
        return match ($this) {
            self::ID => 'ID',
            self::NAME => '名前',
            self::EMAIL => 'メールアドレス',
            self::EMAIL_VERIFIED_AT => 'メール認証日時',
            self::PASSWORD => 'パスワード',
            self::REMEMBER_TOKEN => 'トークン',
            self::CREATED_AT => '作成日時',
            self::UPDATED_AT => '更新日時',
            default => throw new \Exception('Invalid column'),
        };
    }

    /**
     * @return array Userのカラム定義を返す
     */
    public static function columns(): array
    {
        // TABLE_NAMEを除外
        return array_values(array_filter(self::cases(), fn ($key) => $key !== self::TABLE_NAME));
    }
}
