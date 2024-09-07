<?php

namespace App\ValueObjects\Stock;

use App\Facades\Utility\CustomForm;
use App\ValueObjects\ValueObject;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Image extends ValueObject
{
    public const NAME = 'image';

    public const LABEL = '写真';

    protected string $name = self::NAME;

    protected string $columnName = self::NAME;

    protected string $label = self::LABEL;

    protected string $type = 'image';

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected ?int $maxFileSize = 5120; // kb単位

    protected bool $required = false; // DB Nullable

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
        // 例）stock_20210901120000_1_image.jpg
        return sprintf('stock_%s_%s_image.%s',
            Carbon::now()->format('YmdHis'),
            Auth::id(),
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

        return '';
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
    public function input(array $attributes = []): string
    {
        $attributes['fileAccept'] = implode(',', $this->fileExtensions(true));

        return CustomForm::make($this)
            ->label($attributes)
            ->input($attributes)
            ->render();
    }
}
