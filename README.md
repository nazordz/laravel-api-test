# test-web backend laravel
test-web is developed using [Laravel 8](https://laravel.com/docs/8.x)

# About test web - Inventory
This is web application for accomplish my interview proccess at PT. deptech digital indonesia. According the test this app is contain resource api for :
1. Management User
2. Management Category Product
3. Management Product
4. Management Transaction

# Requirement
1. PHP >= 8
2. MySQL 8
3. Composer

# Installation
1. create your db
2. copy `.env` and customizing for your db
3. run in terminal
```bash
composer install
php artisan migrate
php artisan db:seed
php artisan storage:link
```
4. serve it
```bash
php artisan serve
```
# Additional Package
1. [Laravel sanctum](https://laravel.com/docs/8.x/sanctum)

# Author
nazor.dz@gmail.com
