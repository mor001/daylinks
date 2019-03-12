# 開発環境構築手順(Windows + xampp バージョン)

## Xamppインストール
- インストールが終わったらApacheとMySQLをStart
- ブラウザを立ち上げhttp://localhost にアクセスしてXamppの初期ページが表示されることを確認
- MySQLのadminボタンを押す
- phpMyAdminが開くのでDBを作成する  (phpMyAdmin消してるから画面分からん)
- C:\xampp\apache\conf\httpd.confを開いて以下のように変更
DocumentRoot "C:/xampp/htdocs" → DocumentRoot "C:/xampp/htdocs/public"
<Directory "C:/xampp/htdocs"> → <Directory "C:/xampp/htdocs/public">
- 修正したらapache再起動  stopボタン → startボタン

## node.jsのインストール
- https://nodejs.org/ja/ ここから推奨版をダウンロードしてインストールする
https://qiita.com/taiponrock/items/9001ae194571feb63a5e
- コマンドプロンプトを立ち上げてnpm -vと入力しエンター。コマンドが動くことを確認。

## Composerのインストール
-  https://getcomposer.org/doc/00-intro.md#installation-windows から Composer-Setup.exe をダウンロードしてインストールする
https://qiita.com/mikoski01/items/266469535e860312145d#%E3%82%A4%E3%83%B3%E3%82%B9%E3%83%88%E3%83%BC%E3%83%A9%E3%83%BC%E3%81%AB%E3%82%88%E3%82%8B%E3%82%BB%E3%83%83%E3%83%88%E3%82%A2%E3%83%83%E3%83%97
- コマンドプロンプトを立ち上げて composer -V と入力しエンター。コマンドが動くことを確認。

## GitとTortoiseGitのインストール
- こちらを参考に。
https://qiita.com/SkyLaptor/items/6347f38c8c010f4d5bd2


## ソースコードの配置
- C:\xampp\htdocs の中身を一旦全部消す
- (zipの場合)https://github.com/mor001/test2/tree/develop からソースコードをダウンロード
- (zipの場合)ダウンロードしたzipを解凍して中身を全てC:\xampp\htdocsに移動する
- (gitの場合)https://github.com/mor001/test2/tree/develop からソースコードをOpen in desktop
- (gitの場合)TortoiseGitのダイアログが表示されるのでURLはそのまま、ディレクトリをC:\xampp\htdocsに。
- ※この時C:\xampp\htdocsが空でないと失敗するので注意。
- (gitの場合)C:\xampp\htdocsで右クリック→TortoiseGit→切り替え→ダイアログが開くのでブランチをremotes/origin/developを選択しOK
- C:\xampp\htdocs直下に .env.example が 存在するので .env にファイル名を変更する(先頭はピリオドなので注意。Windowsでは．で始まるファイル名はつけれないので.env.exampleをエディタで開いて必要な変更を加えた後ファイル名を.envで保存する)
- .envを開き必要な箇所を書き換える

```
DB_DATABASE=(自分で作ったDBに合わせる)
DB_USERNAME=root(自分で作ったDBに合わせる)
DB_PASSWORD=(自分で作ったDBに合わせる)

(以下を追記する)
DEBUGBAR_ENABLED=true
JWT_SECRET=3yV5xVWwAAcrfh29aISjIEb1Rdscmkv4
JWT_TTL=300

```

## 必要なライブラリのダウンロード
- エクスプローラでC:\xampp\htdocsをShift＋右クリック → 「PowerShellウィンドウをここに開く」を選択
- npm install と入力してエンター (しばらく時間がかかる)  ※ちなみにvue.jsが使用するライブラリをインストールしている
- composer install と入力してエンター (しばらく時間がかかる) ※ちなみにLaravelが使用するライブラリをインストールしている

## DBへデータ投入
- そのままPowerShellの画面で、 php artisan migrate:refresh --seed と入力しエンター。DBにテーブル作成＋データ投入が行われる。

## hostsの書き換え
- メモ帳を開く際に、【メモ帳アイコンを右クリック→管理者として実行】をしてからC:\Windows\System32\drivers\etc\hostsファイルを開く。
- 以下の2行を追記する。  (※ちなみにhosts内で先頭に#が付く行はコメント行)

```
127.0.0.1 test1.localhost
127.0.0.1 test2.localhost
```

## アプリ実行
- そのままPowerShellの画面で、 npm run watch と入力しエンター
  ※PowerShellはこれ以降監視モードになるので、止めるときはCtrl + C で止まる
- http://test1.localhost にアクセス。画面が表示されたら成功。

## ログインID
- muto/aaa111
- chono/aaa111
- hashimoto/aaa111
