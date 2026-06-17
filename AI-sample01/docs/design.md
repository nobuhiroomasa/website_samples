# docs/design.md

## 技術構成
- Backend: Laravel
- Template: Blade
- Frontend: Vite / Tailwind CSS
- Database: MySQL または SQLite
- Test: PHPUnit / Laravel Feature Test

## ディレクトリ方針
- Controller: app/Http/Controllers
- Model: app/Models
- Migration: database/migrations
- Seeder: database/seeders
- View: resources/views
- Route: routes/web.php
- CSS/JS: resources/css, resources/js

## 基本設計
- 画面表示は Blade を使う
- DB操作は Eloquent を使う
- 入力チェックは Request または Controller で行う
- 共通レイアウトは layouts/app.blade.php にまとめる
- 一覧、詳細、作成、編集の画面を分ける

## 画面構成
- トップページ（items 一覧への導線）
- 一覧ページ
- 詳細ページ
- 新規作成ページ
- 編集ページ
- 削除処理

## デザイン方針
- スマホ対応
- シンプルで見やすいUI
- ボタンやフォームの余白を広めにする
- エラー表示をわかりやすくする
