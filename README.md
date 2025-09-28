
# Описание
- Проект Laravel для синхронизации данных API с MySQL
- Сервисы: app/Services/ApiService.php
- Модели: app/Models/{Sale,Order,Stock,Income}.php
- Миграции: database/migrations/*
- Команды: app/Console/Commands/SyncApiData.php
## База данных
- Локальные миграции: sales, orders, stocks, incomes (посмотреть SQL dump).
- Удаленная DB: q999200r_wb_api (таблицы: sales, orders, stocks, incomes).
- [Доступ к удаленной бд](https://gravity.beget.com/phpMyAdmin/index.php) user: q999200r_web_api, password: User1234AAA
## Установлено
- `composer install`
- `php artisan migrate`
- `php artisan sync:api`
## API эндпоинты
- GET /api/sales
- GET /api/orders
- GET /api/stocks
- GET /api/incomes

## [Видеодемонстрация API](https://cloud.mail.ru/public/r6iw/BuyTYHdua)

## Планируется:
- создать интерфейс

## Стек: docker/docker-compose, php 8.1, Laravel 8, Laravel Octane
