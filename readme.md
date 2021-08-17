#　開発環境
- Laradock : Dockerを使うための設定ファイルの集まりで、簡単にローカル環境を立ち上げることが出来る。

## 機能一覧
- 会員登録、ログイン
- ページネーション機能
- フラッシュメッセージ機能
- メール送信


## コマンド
- workspaceコンテナに接続して、PHPコマンド実行
`docker-compose exec workspace bash`

## Todo
- [x] 商品テーブル増やす 「詳細説明」「商品コード」「在庫数」「レビュー」など。それにともないDB設計する。
- [x] joinをsqlで描いてみる。
- [x] joinではなく、hasMany関数で取得する。
- [x] バリデーションチェックを入れる。
- [x] 商品(Itemモデル)を追加できるようにする。
- [x] 商品詳細で名前か、金額を更新したときに、どちらを更新したかをフラッシュメッセージで出力する。
- [ ] 商品テーブルに写真を追加。
- [ ] Laravelのバリデーションメソッドを使うのではなく、phpの関数を使ってバリデーションチェックをする。



ayaneru@gmail.com


user
 * id        : ユーザーid (主キー)
 * name      : ユーザー名
 * email     : email

new_cart_item
 * id       : id (主キー)
 * user_id  : ユーザーid (外部キー)
 * item_id  : 商品id (外部キー)
 * quantity : 量
 * update_at : 更新日
 * create_at : 追加日

new_items
 * id       : 商品id (主キー)
 * name     : 商品名
 * amount   : 金額
 * explanation : 商品説明
 * stock    : 在庫数
 * update_at : 更新日
 * create_at : 追加日

new_comment
 * id       : コメントid (主キー)
 * body     : コメント
 * item_id  : アイテムid (外部キー)
 * user_id  : ユーザーid (外部キー)
 * good    : 賛成
 * bad    : 反対
 * del_flg  : フラグ
 * update_at : 更新日
 * create_at : 追加日
