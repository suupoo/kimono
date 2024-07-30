<?php

namespace App\ValueObjects\Master\Administrator;

use App\ValueObjects\ValueObject;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Image extends ValueObject
{
    public const NAME = 'image';

    public const LABEL = 'アイコン';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'image';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected ?int $maxFileSize = 2048; // kb単位

    protected bool $required = false; // DB Nullable

    protected bool $primaryKey = false;

    /**
     * 画像の対応拡張子
     * @param bool $withDot 結果に「.」を含めるフラグ
     * @return array
     */
    public function fileExtensions(bool $withDot = false) :array
    {
        $extensions = [
//            'jpeg',
            'jpg',
//            'gif',
//            'png',
        ];
        return $withDot ? array_map(fn($ext) => '.'.$ext, $extensions) : $extensions;
    }

    /**
     * ストレージ配下のアップロード先
     * @return string
     * @throws \Exception
     */
    public function fileUploadPath() :string
    {
        $user = Auth::user();
        if(!$user) throw new \Exception('アップロードするにはログインが必要です。');

        return "administrator";
    }

    public function rules(): array
    {
        $routeName = Route::currentRouteName();

        return match ($routeName) {
            // ルート名 => ルール
            default => [
                'nullable',
                'image',
                'mimes:'.implode(',', $this->fileExtensions()),
                "max:$this->maxFileSize",
            ],
        };
    }

    /**
     * 入力項目を返す
     */
    public function input(array $attributes = []): View
    {
        $attributes['fileAccept'] = implode(',', $this->fileExtensions(true));

        return view('components.form.image', [
            'column' => $this,
            'attributes' => $attributes,
        ]);
    }
}
