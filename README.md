## Как развернуть проект

1) Копируем .env.example в .env (для тестового они полностью совпадают)
2) alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
3) sail up -d
4) sail composer install
5) sail artisan migrate
6) sail npm build
7) sail npm run
