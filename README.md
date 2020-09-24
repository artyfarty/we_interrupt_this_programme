# Короче

Делаешь в .env `WITP_USERNAME`, `WITP_EMAIL`, `WITP_PASSWORD`. Для авторизации используй емейл и пароль.

Настраиваешь базу мускуль или sqlite.

Делаешь
```
brew install php@7.3
brew link php@7.3 --force

composer install
php artisan migrate:fresh --seed
npm install
npm run dev

php artisan serve
```

Если sqlite `sqlite3 database/database.sqlite` и ^D

и в .env
```
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```
