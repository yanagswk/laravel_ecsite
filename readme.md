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
- [ ] 商品テーブル増やす 「詳細説明」「商品コード」「在庫数」「レビュー」「写真」など
- [x] joinをsqlで描いてみる
- [x] joinではなく、hasMany関数で取得する
- [x] バリデーションチェックを入れる
- [ ] 商品(Itemモデル)を追加できるようにする。


ayaneru@gmail.com