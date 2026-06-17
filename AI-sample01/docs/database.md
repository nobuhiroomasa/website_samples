# docs/database.md

## DB設計

### users テーブル
Laravel標準の users テーブルを使用する。

| カラム | 型 | 内容 |
|---|---|---|
| id | bigint | ID |
| name | string | ユーザー名 |
| email | string | メールアドレス |
| password | string | パスワード |
| created_at | timestamp | 作成日時 |
| updated_at | timestamp | 更新日時 |

### items テーブル
アプリで管理するメインデータ。

| カラム | 型 | 内容 |
|---|---|---|
| id | bigint | ID |
| title | string | タイトル |
| body | text | 本文 |
| image_path | string nullable | 画像パス（初回実装では未使用） |
| user_id | foreignId nullable | 作成ユーザーID |
| created_at | timestamp | 作成日時 |
| updated_at | timestamp | 更新日時 |

## リレーション
- User hasMany Item
- Item belongsTo User

## 注意点
- DB変更は migration で行う
- ダミーデータが必要な場合は Seeder / Factory を使う
- 画像パスはDBに保存し、画像本体は storage に保存する
- 初回実装では `image_path` と `user_id` は `null` を許可する
- `user_id` は `users.id` を参照し、ユーザー削除時は `nullOnDelete` にする
