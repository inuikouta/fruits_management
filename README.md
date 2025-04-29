# もぎたて

## 環境構築
### github
1. [git clone リンク](https://github.com/inuikouta/fruits_management.git)

### Dockerビルド
1. docker-compose up --build -d

### Laravel環境構築
1. cp .env.example .env
2. docker-compose exec php bash
2. composer install
3. php artisan key:generate
4. php artisan migrate
5. php artisan db:seed

## 使用技術
- php 8.2.28
- Laravel 8.83.29
- mysql 8.0.26

## ER図
![Image](https://github.com/user-attachments/assets/15d29d16-5fb4-4717-ade7-a534f9252f03)

## URL
- 開発環境：http://localhost/products
- phpmyadmin：http://localhost:8080

> **注意:**  
> ymlファイルの記述が、LMSの教材とは少し異なっています。  
> ### mysql
> - platform: linux/amd64
> ### phpmyadmin
> - image: arm64v8/phpmyadmin