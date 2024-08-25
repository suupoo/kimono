<?php

namespace App\ValueObjects\Master\Banner;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\ValueObject;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Image extends ValueObject
{
    public const NAME = 'image';

    public const LABEL = 'バナー画像';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'image';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected ?int $maxFileSize = 2048; // kb単位

    protected bool $required = true; // DB Nullable

    protected bool $primaryKey = false;

    /**
     * 画像の対応拡張子
     *
     * @param  bool  $withDot  結果に「.」を含めるフラグ
     */
    public function fileExtensions(bool $withDot = false): array
    {
        $extensions = config('custom.file.image.extensions');

        return $withDot ? array_map(fn ($ext) => '.'.$ext, $extensions) : $extensions;
    }

    /**
     * ファイル名生成
     */
    public function createFileName(string $extension): string
    {
        // 例）20210901120000_1_image.jpg
        return sprintf('%s_image.%s',
            Carbon::now()->format('YmdHis'),
            $extension
        );
    }

    /**
     * ストレージ配下のアップロード先
     *
     * @throws \Exception
     */
    public function fileUploadPath(): string
    {
        $user = Auth::user();
        if (! $user) {
            throw new \Exception('アップロードするにはログインが必要です。');
        }

        return 'banner';
    }

    public function rules(): array
    {
        $routeName = Route::currentRouteName();

        $imageRules = [
            'image',
            'mimes:'.implode(',', $this->fileExtensions()),
            "max:$this->maxFileSize",
        ];

        return match ($routeName) {
            // ルート名 => ルール
            'system.banners.store' => array_merge([
                'required',
            ], $imageRules),
            default => array_merge([
                'nullable',
            ], $imageRules),
        };
    }

    /**
     * 入力項目を返す
     */
    public function input(array $attributes = []): string
    {
        $attributes['fileAccept'] = implode(',', $this->fileExtensions(true));

        return CustomForm::make($this)
            ->label($attributes)
            ->input($attributes)
            ->render();
    }
}
