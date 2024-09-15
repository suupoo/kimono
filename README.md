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

| タイプ       | 絵文字 | 備考                       |
|-----------|-----|--------------------------|
| はじめてのコミット | 🎉  |                          |
| 対応中       | 🚧  | 対応途中でキリのいいコミット           |
| 新機能       | ✨   |                          |
| コメント      | 💬  |                          |
| コードフィックス  | 🧹  | Laravel Pintの適用          |
| バグ修正      | 🐛  |                          |
| リファクタリング  | ♻️  |                          |
| ドキュメント    | 📚  |                          |
| デザインUI/UX | 🎨  |                          |
| パフォーマンス   | 🐎  |                          |
| ツール       | 🔧  |                          |
| テスト       | 🚨  |                          |
| 非推奨追加     | 🪦  | やむなく対応したが推奨されていないやり方での対応 |
| 削除        | 🗑️ | 不要となった実装や機能の廃止対応         |
| バージョンタグ   | 🔖  | 用途検討中                    |


## 便利なLaravelコマンド

### マイグレーション関係
| コマンド                                    | 説明                                |
|-----------------------------------------|-----------------------------------|
| `php artisan migrate`                   | マイグレーションする                        |
| `php artisan migrate:status`            | マイグレーションのステータスを確認する               |
| `php artisan migrate:rollback --step 1` | マイグレーションを１マイグレーションファイル分だけロールバックする |

### makeコマンド
| コマンド                                           | 説明                |
|------------------------------------------------|-------------------|
| `php artisan make:model ModelName`             | モデルを作成する          |
| `php artisan make:model ModelName --migration` | モデル＋マイグレーションを作成する |
| `php artisan make:controller ControllerName`   | コントローラを作成する       | 

### キャッシュクリア
| コマンド                       | 説明             |
|----------------------------|----------------|
| `php artisan cache:clear`  | キャッシュをクリアする    |
| `php artisan config:clear` | 設定キャッシュをクリアする  |
| `php artisan route:clear`  | ルートキャッシュをクリアする |
| `php artisan view:clear`   | ビューキャッシュをクリアする |

### ルーティング関係
| コマンド                     | 説明         |
|--------------------------|------------|
| `php artisan route:list` | ルート一覧を表示する |

### コードスタイル関係
| コマンド                       | 説明                        |
|----------------------------|---------------------------|
| `./vendor/bin/pint`        | コーディング規約に則り、自動修正を適用する     |
| `./vendor/bin/pint --test` | コーディング規約に則り、自動修正をチェックだけする |

## コーディング規約
### 全般
- 原則`Resource`に則り、一覧表示・ 新規登録・更新・削除・詳細の規則でそれぞれのモデルを作成する
  - 原則、主キー`id`はルートパラメータにて引き渡す

    | 操作     | 概要         | メソッド   | ルーティングパターン   |
    |--------|------------|--------|--------------|
    | Index  | 一覧表示     　 | GET    | /            |
    | Create | 新規作成フォーム表示 | GET    | /create      |
    | Store  | 新規作成処理     | POST   | /store       |
    | Edit   | 更新フォーム表示   | GET    | /{id}/edit   |
    | Update | 更新処理       | PUT    | /{id}/update |
    | Show   | 詳細表示       | GET    | /{id}/show   |
  - | Delete | 削除処理       | DELETE | /{id}/delete |

  - 新規登録処理と更新処理が一体化している場合は`Save`に集約する

    | 操作   | 概要   | メソッド | ルーティングパターン |
    |------|------|------|------------|
    | Save | 登録処理 | POST | 機能に準ずる     |

##  Installation for Custom CMS
1. Gitからプロジェクトをクローンする
2. `composer install`パッケージをインストールする
3. `php artisan storage:link`シンボリックリンクを貼る
4. `npm install`パッケージをインストールする
5. `npm run dev`でビルドツールを立ち上げる
6. `php artisan migrate`でマイグレーション
7. `php artisan custom:init`でカスタムCMSの初期設定
   - 管理者名：`システム` メールアドレス `system@example.com` パスワード `password`でシステム管理者を作成

##  Commands for Custom CMS
- `php artisan custom:init` カスタムCMSの初期設定
- `php artisan custom-admin:add ユーザ名 email@example.com` 管理者を作成
- `php artisan custom-feature:add 機能キー名 機能名` 機能定義を追加
