# AGENTS.md

## このプロジェクトについて
このプロジェクトは Laravel を使ったWebアプリケーションです。

## 作業前に必ず読むファイル
- docs/requirements.md
- docs/design.md
- docs/database.md
- docs/routes.md
- docs/tasks.md
- docs/test.md

## 基本ルール
- いきなり実装せず、まず実装方針を簡単に説明すること
- tasks.md の順番に沿って作業すること
- 大きな仕様変更を勝手にしないこと
- 不明点があれば確認すること
- Laravelの標準構成をなるべく崩さないこと
- Controller、Model、Migration、Seeder、Request、Bladeの役割を分けること
- 同じ処理を無駄に重複させないこと
- 実装後に変更内容、確認方法、未対応事項をまとめること

## 使用技術
- PHP
- Laravel
- Blade
- Vite
- MySQL または SQLite
- Tailwind CSS

## よく使うコマンド
- 依存関係インストール: composer install
- フロント依存関係: npm install
- 開発サーバー: php artisan serve
- Vite起動: npm run dev
- マイグレーション: php artisan migrate
- シーダー実行: php artisan db:seed
- テスト実行: php artisan test
- キャッシュクリア: php artisan optimize:clear

## 注意点
- .env は編集しないこと
- .env.example に必要な環境変数を追加すること
- DB変更が必要な場合は migration を作成すること
- 既存テーブルを直接壊す変更は避けること
- バリデーションは FormRequest または Controller で明確に行うこと
- 認証が必要な画面には middleware を使うこと