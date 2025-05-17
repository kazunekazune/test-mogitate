# アプリケーション名
mogitate

## 環境構築
git clone https://github.com/kazunekazune/test-mogitate.git
cd test-mogitate
mkdir -p docker/nginx docker/php docker/mysql src

# docker-compose.ymlとdocker/nginx/default.confを作成
docker compose up -d
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


## 使用技術（実行環境）
- Laravel 12.x
- PHP 8.2
- MySQL 8.x
- Docker
- diagrams.net（ER図作成）

## ER図
![ER図](./er.png)
<!-- 画像ファイルをdocsフォルダに入れた場合は ![ER図](./docs/er.png) にしてください -->

## URL
- 開発環境: http://localhost/
- phpMyAdmin: http://localhost:8080/
