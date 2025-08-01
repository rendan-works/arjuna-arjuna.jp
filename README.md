# プロジェクト概要
| name  | description |
| ---- | ---- |
| サイトマップ | [url](https://docs.google.com/spreadsheets/d/1Pmc2eneJbAd0kAcTUgl7VZp-G3VqfH2H4vWI1nje7Cc/edit?usp=sharing) |
| サイト | [url](https://arjuna.jp/) |
| テストサイト | [url](https://rendan1.xsrv.jp/arjuna/) |
| デザイン一覧 | [url](https://design-arjuna.com/test/arjuna/navi.html) <br>ID:design<br>PW:arjuna|

## 開発環境

### node
v14.14.0

### gulp
v4.0.2



# 公開
- 公開：2024年11月16日
  


# 開発理念
## 全体方針
- 成果物（ビルド後ファイル）は基本Gitに残さない
- public_html/ は、初回リリース時のみ /wp/ 一式をzip圧縮してプッシュしリリース
- 修正履歴はリリースで管理

## 全体の流れ
### 開発中
- 開発中はdev/ を編集。public_html/（= dist）へビルド
- wpのみpublic_html/へ手動で設置。

### 公開
- public_html/のwp/をzipで圧縮しプッシュ。（リポジトリへは一時的にプッシュして即削除。 ）
- 公開用のリリースを行ったら、public_html/ は.gitkeepのみにして再リリースし修正用の形式を取る。
- Pugなどは、_bk_release/ へ移動（※FTP内のPHPファイルを尊重するため、Pugは参照用バックアップ）
- 公開時のmySQLもwpディレクトリに入れておく。（ファイル名を見ればわかるのでそのまま入れて問題ない）

※ _bk_releaseは参照用バックアップ  
※ 修正時にサーバーを修正した形跡がなければ、そのまま流用して修正を行なったり、ページ追加時にベースとして利用する。

### 修正
- 公開後はHTMLやPHPなどのファイルはサーバーのものを尊重
- HTMLやPHPはFTPからローカルにダウンロード
- アセット周りは、FTPからファイルの変更日を見て未修正なら開発データを修正
- コンパイルしたら、FTPでアップ
- Githubへプッシュする時は、public_html/ は.gitkeepのみにしてプッシュ。リリース。
  
※wp/ のみFTPからダウンロードするのは面倒なので、公開時のwp.zipを解凍して使っても良い。  
※修正のファイルをサーバーにアップロードする際は、必ずサーバー内でバックアップをとる。  

### 動画
- 容量のある動画のみドロップボックスで管理  
- https://www.dropbox.com/home/github ここに同じディレクトリを作成し、動画のみをアップ。
- 主に公開時の動画ファイルとなるが、修正が入った場合は、ドロップボックス内でバックアップをとっておく。
例）_bk_yyyymm_pv.mp4


### v2の対応
- v2のrelease_public_htmlがある場合は、リリースで（ここまではrelease_public_htmlはあるが、以降はv3運用へ切り替えるため存在しない）と明記してv3運用へ切り替える。
- 合わせて、v3のREADME.mdへ一部切り替える（プロジェクト概要以外）


### v1以前の対応
v1（nouhin_data、update_data、takeover_data、dev_data、guidelineなどがあるもの）は,v3にアップデートせずそのまま運用する。


## ディレクトリ構成
```
└ project/
	├ dev/
	│	├ dev_html/
	│	│	├ assets/
	│	│	├ _bk_release/ （Pug関連のデータを移動）
	│	│	│	├ _bk_pug/
	│	│	│	├ _bk_static_html/
	│	│	│	├ include/
	│	│	│	├ include_pug/
	│	│	│	├ wp/
	│	│	│	└ index.pug
	│	└ gulp/
	│		├ gulpfile.js
	│		├ package-lock.json
	│		└ package.json
	└ public_html/
		├ wp.zip（初回のみの残し、以降は削除。mySQLも忘れずに）
		└ .gitkeep
```

## 初回のコミット＆リリース名
- コミット「release yyyymm 公開データ」
- リリース「release.yyyymm」
- コメント「公開時のデータ。wpがzipで格納。」

リリース後に、public_html/ からwp.zipを削除し  
.gitkeepのみにしてから再プッシュ

- コミット「init yyyymm 修正用に準備完了」
- リリース「init.yyyymm」
- コメント「修正用に準備完了。以降は開発データのみアップ。」
  
## v2からv3へバージョンアップのコミット＆リリース名
- コミット「init v3 yyyymm 修正用に準備完了（release_public_htmlを削除）」
- リリース「init.v3.yyyymm」
- コメント
修正用に準備完了。以降は開発データのみアップ  
※これ以前はrelease_public_htmlはあるが、ここからはv3運用へ切り替えるため存在しない



# 命名規則
## リポジトリ
- リポジトリは「会社名（ハイフン）サイトURL」
- サイトURLは`https://`以降のを入れ、スラッシュはドットに置換する
例）mont-mont.jp  
例）`mont-www.anesis-g.com.brandstory  `

- Aboutには「会社名（スペース）案件名」
- WebURLにサイトのURLを入れる
例）モンブラン あめいろ工務店  
例）`https://amiro-home.com`

## コミット
- pushするときのcommitは  「プレフィックス（スペース）yyyymm（スペース）簡単な名前」  
例）mod 202507 トップページにボタン追加  

- 遅れてgitにアップする場合は、プレフィックスの後に「_data」をつけて明確化。  
例）release_data 202108 公開時のデータ


## リリース・タグ
- 開発時や公開時、修正時にタグ付けをして明確化。タグは「プレフィックス（ドット）yyyymm」で統一します。  
例）mod.202107
- 詳細はコメントで残す。

| プレフィックス  | description |
| ---- | ---- |
| dev | 開発時 |
| release | 公開時 |
| init | 準備完了 |
| mod | 公開後の修正時 |

