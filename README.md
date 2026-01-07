# Todo/Calendar アプリケーション (CakePHP 5)  
## 環境  
<img alt="Static Badge" src="https://img.shields.io/badge/cakephp-c?style=plastic&logo=cakephp&logoColor=%23ffffff&labelColor=%23D33C43&color=%23D33C43"> <img alt="Static Badge" src="https://img.shields.io/badge/ubuntu-u?style=plastic&logo=ubuntu&logoColor=%23ffffff&labelColor=%23E95420&color=%23E95420"> <img alt="Static Badge" src="https://img.shields.io/badge/Docker-d?style=plastic&logo=docker&logoColor=%23ffffff&labelColor=%232496ED&color=%232496ED">
<img alt="Static Badge" src="https://img.shields.io/badge/apache-a?style=plastic&logo=apache&logoColor=ffffff&labelColor=%23D22128&color=%23D22128">
<img alt="Static Badge" src="https://img.shields.io/badge/MySQL-m?style=plastic&logo=mysql&logoColor=%23ffffff&labelColor=%234479A1&color=%234479A1">
<img alt="Static Badge" src="https://img.shields.io/badge/php-p?style=plastic&logo=php&logoColor=%23ffffff&labelColor=%23777BB4&color=%23777BB4">  

## プロジェクト概要

このアプリケーションは、以下の点を主な学習・検証目的としています。

- CakePHP 5 における MVC 構成と責務分離の理解
- ORM（Table / Entity）を用いたデータ操作
- Authentication プラグインを用いたユーザー認証
- Date / Calendar ロジックの実装と再利用可能な設計
- マイグレーションによる DB 管理

その題材として、Todo 管理とカレンダー表示機能を実装しています。
## 主な機能

- ユーザー認証：メールとパスワードでログイン／ログアウトができます。
- Todo 管理：タイトル・詳細・タグ・期限（deadline）を持つ Todo を登録・編集・削除できます。
- カレンダー表示：指定した年月のカレンダーを描画し、その日に紐づく Todo のタイトルを表示します。
- ページング：Todo 一覧はページネーションで分割表示します。

## 使用技術
| カテゴリ | 使用技術 |
| :--- | :--- |
| **Backend** | CakePHP 5.1 系 |
| **Frontend** | CakePHP Templates (PHP) |
| **Infrastructure** | Docker Compose (Apache / PHP / MySQL) |
| **OS Environment** | WSL2 (Ubuntu / Alpine Linux) |
| **Database** | MySQL 8.x |

## セットアップ手順

### 1. インフラのビルドと起動
```
docker compose build
docker compose up -d
```
### 2. バックエンドの初期化

```
docker exec -it cakephp-web-1 bash
cd html
composer install
```
※コンテナ名は docker compose ps で確認してください。
### 3. マイグレーション実行
```
bin/cake migrations migrate
```

### 4. 権限設定（必要なら）

```
# tmp/ と logs/ に Web サーバーが書き込めるようにする例
chmod -R 0777 tmp/ logs/
```

## ディレクトリ構成（主なもの）

- `bin/` — CLI ラッパー（`bin/cake` など）
- `config/` — アプリ設定（`app.php`、`app_local.php`、ルーティング、マイグレーションなど）
- `src/` — アプリケーションソース（MVC の Controller / Model / View、定数クラスなど）
  - `Controller/` — コントローラ（`TodosController`, `UsersController`, `CalendarsController` 等）
  - `Model/Table/` — テーブルクラス（`UsersTable`, `TodosTable`）
  - `Constants/` — 定数クラス（`Weekday`）
- `templates/` — ビュー（テンプレート）
  - `Todos/`, `Users/`, `Calendars/` などの画面テンプレート
- `webroot/` — 公開ドキュメントルート（CSS / JS / 画像）
- `tests/` — ユニット／機能テスト（PHPUnit）
- `config/Migrations/` — DB マイグレーション定義
- `logs/`, `tmp/` — 実行時のログとキャッシュ
- `vendor/` — Composer 依存ライブラリ

（上記は CakePHP アプリの標準構成に沿っています）

## 設計・実装の特徴

- MVC（Model-View-Controller）構成：
  - Controller はリクエストを受け取り、Model（テーブル）からデータを取得して View に渡します。
  - `src/Controller/TodosController.php` などがその例で、CRUD 操作を実装しています。

- ORM（CakePHP ORM）を使用：
  - `src/Model/Table/*.php` にテーブル定義（バリデーションや関連付け）があります。
  - 例えば `TodosTable` は `belongsTo('Users')` を持ち、`Timestamp` ビヘイビアで自動的に created/modified を管理します。

- バリデーションとルール：
  - `validationDefault()` で入力チェックを行い、`buildRules()` で一意制約や外部キー制約の検証をしています。

- カレンダー表示ロジック：
  - `CalendarsController::generateCalendar()` が表示期間（カレンダーの開始日・終了日）を DatePeriod で生成します。
  - `src/Constants/Weekday.php` に曜日や開始曜日の定義をまとめ、テンプレート側で利用しています。

- 認証：
  - `cakephp/authentication` プラグインを使ってログイン状態の判定やログアウト処理を実装しています（`UsersController::login()` など）。

- マイグレーションベースの DB 構築：
  - `config/Migrations` にマイグレーションがあり、`vendor/bin/cake migrations migrate` でテーブルを作成できます。

- 責務分離：
  - Controller はリクエスト制御と画面遷移に専念
  - 日付・曜日・カレンダー生成ロジックは
    再利用可能なクラス／定数に切り出しています。

## 今後の改善予定

- Todo に優先度や完了フラグを追加する。
- カレンダーから Todo を追加できる UI の追加。
