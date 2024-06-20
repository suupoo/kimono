<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About CMS-Templates

最新CMSテンプレートのブランチ：`version/prototype`

## 想定環境

| サービス名      | バージョン     | 備考                      |
|------------|-----------|-------------------------|
| PHP        | 8.2以上     | Laravel 11で必須           |
| Composer   | 2.0以上     |                         |
| Node.js    | 16以上      |                         |
| Laravel    | 11.0以上    |                         |
| Nginx      | 最新        |                         |
| MariaDB    | 最新        |                         |
| PhpMyAdmin | 最新        | 任意                      |
| Mailhog    | 最新        | 任意。SESなど外部サービスを使う場合は不要。 |

## Git
### コミット

| タイプ       | 絵文字  | 備考                       |
|-----------|------|--------------------------|
| はじめてのコミット | 🎉   |                          |
| 対応中       | 🚧   | 対応途中でキリのいいコミット           |
| 新機能       | ✨    |                          |
| バグ修正      | 🐛   |                          |
| リファクタリング  | ♻️   |                          |
| ドキュメント    | 📚   |                          |
| デザインUI/UX | 🎨   |                          |
| パフォーマンス   | 🐎   |                          |
| ツール       | 🔧   |                          |
| テスト       | 🚨   |                          |
| 非推奨追加     | 🪦 | やむなく対応したが推奨されていないやり方での対応 |
| 削除        | 🗑️  | 不要となった実装や機能の廃止対応         |
| バージョンタグ   | 🔖   | 用途検討中                    |


## 便利なLaravelコマンド

### マイグレーション関係
| コマンド | 説明 |
| --- | --- |
| `php artisan migrate` | マイグレーションする |
| `php artisan migrate:status` | マイグレーションのステータスを確認する |
| `php artisan migrate:rollback --step 1` | マイグレーションを１マイグレーションファイル分だけロールバックする |

### makeコマンド
| コマンド                                           | 説明                |
|------------------------------------------------|-------------------|
| `php artisan make:model ModelName`             | モデルを作成する          |
| `php artisan make:model ModelName --migration` | モデル＋マイグレーションを作成する |
| `php artisan make:controller ControllerName`   | コントローラを作成する       | 

### キャッシュクリア
| コマンド | 説明 |
| --- | --- |
| `php artisan cache:clear` | キャッシュをクリアする |
| `php artisan config:clear` | 設定キャッシュをクリアする |
| `php artisan route:clear` | ルートキャッシュをクリアする |
| `php artisan view:clear` | ビューキャッシュをクリアする |

### ルーティング関係
| コマンド | 説明 |
| --- | --- |
| `php artisan route:list` | ルート一覧を表示する |

### コードスタイル関係
| コマンド                 | 説明                       |
|----------------------|--------------------------|
| `./vendor/bin/pint`  | コーディング規約に則り、自動修正を適用する    |
| `./vendor/bin/pint --test` | コーディング規約に則り、自動修正をチェックだけする |




