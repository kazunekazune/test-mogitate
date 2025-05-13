# プロジェクト名
mogitate

## 環境構築手順

### 1. リポジトリのクローン
```sh
git clone https://github.com/kazunekazune/test-mogitate.git
cd test-mogitate
```

### 2. ディレクトリ構成の作成（初回のみ）
```sh
mkdir -p docker/nginx docker/php docker/mysql src
```

### 3. docker-compose.ymlとnginx設定ファイルの作成
- プロジェクトルートに `docker-compose.yml` を作成
- `docker/nginx/default.conf` を作成

### 4. Dockerコンテナのビルドと起動
```sh
docker compose up -d
```

### 5. PHPコンテナに入ってLaravelプロジェクトを作成
```sh
docker compose exec php bash
cd /var/www/html
composer create-project laravel/laravel .
cp .env.example .env
# .envのDB設定を下記に修正
# DB_CONNECTION=mysql
# DB_HOST=mysql
# DB_PORT=3306
# DB_DATABASE=laravel_db
# DB_USERNAME=laravel_user
# DB_PASSWORD=laravel_pass
php artisan key:generate
php artisan migrate
exit
```

### 6. 動作確認
- [http://localhost/](http://localhost/) でLaravelの初期画面が表示される
- [http://localhost:8080/](http://localhost:8080/) でphpMyAdminにアクセスできる

---

## 注意点
- **dockerコマンドはローカル（Mac）で実行**
- **artisanコマンドはphpコンテナ内で `/var/www/html` で実行**
- Appleシリコンの場合は `platform: linux/arm64` をdocker-compose.ymlに追記

---

## 参考
- [GitHubリポジトリ](https://github.com/kazunekazune/test-mogitate)
