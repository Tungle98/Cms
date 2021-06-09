# CMS VGS travel

### Server Requirements
```angular2html
- PHP >= 7.1.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension
- Composer install
- Nodejs install
```

### Getting started
Clone project git: git clone https://github.com/vgsholding/WEB_TRAVEL.git
Go to folder: cd ./
Run command: cp .env.example .env (change config connect database)
Run command: php artisan key:generate
Run command: php artisan jwt:secret (generate a key for project)
Run command: composer install
Run command: npm install
Run command: php artisan db:seed --class=PermissionTableSeeder --tao permission
Run command: php artisan db:seed --class=CreateAdminUserSeeder --tao useradmin
Run command: php artisan serve 
```
### permission:create-permission command

```angular2html
php artisan permission:create-permission "edit_post"
```
