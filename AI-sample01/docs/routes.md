# docs/routes.md

## ルーティング設計

### Webルート

| メソッド | URL | 処理 | Controller |
|---|---|---|---|
| GET | / | トップページ | HomeController@index |
| GET | /items | 一覧表示 | ItemController@index |
| GET | /items/create | 作成画面 | ItemController@create |
| POST | /items | 登録処理 | ItemController@store |
| GET | /items/{item} | 詳細表示 | ItemController@show |
| GET | /items/{item}/edit | 編集画面 | ItemController@edit |
| PUT/PATCH | /items/{item} | 更新処理 | ItemController@update |
| DELETE | /items/{item} | 削除処理 | ItemController@destroy |

## 認証追加後の前提
- トップページは items 一覧ページへの導線ページとする
- `items.index` と `items.show` は公開する
- `items.create` `items.store` `items.edit` `items.update` `items.destroy` はログイン必須にする
- 更新後は `items.show`、削除後は `items.index` へ遷移する

## 認証が必要なルート
ログイン機能を入れる場合、作成・編集・削除は auth middleware を使う。

```php
Route::middleware('auth')->group(function () {
    Route::resource('items', ItemController::class)->except(['index', 'show']);
});
```
