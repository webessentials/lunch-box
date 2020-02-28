

## Installation

1. Generate key for app
```$xslt
php artisan key:generate
```

2. Rename file `.env.example` to `.env`
3. Initials database
```$xslt
php artisan migrate
```
4. Generate Passport token keys for security
```$xslt
php artisan passport:install
```
