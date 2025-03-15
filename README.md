# cakephp環境構築用  
## 環境  
<img alt="Static Badge" src="https://img.shields.io/badge/cakephp-c?style=plastic&logo=cakephp&logoColor=%23ffffff&labelColor=%23D33C43&color=%23D33C43"> <img alt="Static Badge" src="https://img.shields.io/badge/ubuntu-u?style=plastic&logo=ubuntu&logoColor=%23ffffff&labelColor=%23E95420&color=%23E95420"> <img alt="Static Badge" src="https://img.shields.io/badge/Docker-d?style=plastic&logo=docker&logoColor=%23ffffff&labelColor=%232496ED&color=%232496ED">
<img alt="Static Badge" src="https://img.shields.io/badge/apache-a?style=plastic&logo=apache&logoColor=ffffff&labelColor=%23D22128&color=%23D22128">
<img alt="Static Badge" src="https://img.shields.io/badge/MySQL-m?style=plastic&logo=mysql&logoColor=%23ffffff&labelColor=%234479A1&color=%234479A1">
<img alt="Static Badge" src="https://img.shields.io/badge/php-p?style=plastic&logo=php&logoColor=%23ffffff&labelColor=%23777BB4&color=%23777BB4">  <img alt="Static Badge" src="https://img.shields.io/badge/bootstrap-b?style=plastic&logo=bootstrap&logoColor=%23ffffff&labelColor=%237952B3&color=%237952B3"> <img alt="Static Badge" src="https://img.shields.io/badge/npm-n?style=plastic&logo=npm&logoColor=%23ffffff&labelColor=%23CB3837&color=%23CB3837"> 


## 構築手順  
#### 1. wsl使用の為、仮想マシン プラットフォームを有効化  
####  (wslがインストールされていない場合:Linuxカーネル更新プログラムパッケージを  
####  インストールする)  
#### 2. wsl --set-default-version 2 コマンドでLinuxを標準でWSL2上で動くように設定  
#### 3. wsl --list --verbose　コマンドでLinuxがWSL1とWSL2のどちらで動いているかを確認  
#### 4. ubuntuをインストール  
#### 5. terminalにてアカウント作成  
※WSLにて環境構築済みの場合、6から作業実施  
#### 6. 任意のフォルダ作成  
#### 7. Docker Desktopインストール  
#### 8. dockerでwslを使用する設定に変更  
#### 9. terminalに戻りdockerで使用するイメージのフォルダ構成作成  
※dockerフォルダ及びその配下、dockerフォルダと同位置に.env、docker-compose.ymlを配置する。  
#### 10. webフォルダ配下にDockerfile作成にて、使用するイメージ作成の設定  
#### 11. composer.ymlにて作成するコンテナの初期状態を  
#### 「ports:」「volumes:」などYAML形式を用いて定義。  
#### 12. mysqlフォルダ配下に使用するイメージの設定ファイル(my.cnf)作成  
#### 13. docker compose up -d　コマンドを実行してコンテナの作成・起動  
#### 14. docker exec -it cakephp-web-1 bashでコンテナにはいる  
#### 15. 以降はcakephp5.0の環境構築  
#### 16. cd ../　1つ上の階層へ移動  
#### 17．composer create-project --prefer-dist cakephp/app:5.* html　コマンドでcakephp5.0インストール  
#### 18. cd html　元の階層へ移動  
#### 19. composer require "cakephp/authentication:^3.0"　コマンドにてlogin実装用packcageインストール   
#### 20. /var/www/html/configにフォルダ移動し、app_local.phpで'Datasources'以降を設定した接続情報に書き換える  
#### 21. localhostにてCakePHPの初期画面が表示されることを確認  
※以降bootstrap使用の為の手順  
#### 22. apt updateコマンドにてcomposerを更新  
#### 23. apt install nodejs npmコマンドにてnpmインストール  
#### 24. composer require friendsofcake/bootstrap-uiコマンドにてbootstrap-uiインストール  
#### 25. ./bin/cake plugin load BootstrapUIコマンドにてプラグインをロード  
#### 25. ./bin/cake bootstrap installコマンドにてbootstrapアセット一式をダウンロード  
#### 26. bin/cake bootstrap modify_viewコマンドにてbootstrapを使用したviewに修正  
#### 26. ./bin/cake bootstrap copy_layoutsコマンドにてBootstrapUIのサンプルレイアウト導入
※bin/cake bake [subcommand] -t BootstrapUIでbakeで生成するファイルをBootstrapUIベースにすることができる
#### 27. bin/cake plugin load DebugKitコマンドでDebugKitが使用可能となる(初回のみ実施)  