
## Server Requirements
```composer log
PHP >= 7.2.0
BCMath PHP Extension
Ctype PHP Extension
Fileinfo PHP extension
JSON PHP Extension
Mbstring PHP Extension
OpenSSL PHP Extension
PDO PHP Extension
Tokenizer PHP Extension
XML PHP Extension

MYSQL Database
```

## Installation
1. Clone project
```composer log
git clone git@github.com:webessentials/lunch-box.git
```

2. Install require packages
```composer log
composer install
```

3. Generate key for app
```$xslt
php artisan key:generate
```

4. Rename file `.env.example` to `.env` and change database info
```composer log
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=DB_NAME
    DB_USERNAME=USER
    DB_PASSWORD=PASSWORD
```
5. Initials database tables
```$xslt
php artisan migrate
```
6. Generate Passport token keys for security
```$xslt
php artisan passport:install
```

7. To run project on local please use command
```composer log
php artisan serve
```
