## Как развернуть проект

1) Копируем .env.example в .env (для тестового они полностью совпадают)
2) composer require laravel/sail --dev --ignore-platform-reqs
3) alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
4) sail up -d
5) sail composer install
6) sail artisan migrate
7) sail npm build
8) sail npm run
