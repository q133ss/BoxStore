# BoxStore

Laravel 13 + Docker

## Требования

- Docker

## Запуск

```bash
docker compose up -d
```

Миграции при первом запуске:

```bash
docker exec boxstore_app php artisan migrate
```

## Адреса

| | |
|---|---|
| Приложение | http://localhost:8080 |
| phpMyAdmin | http://localhost:8081 |
| MySQL | localhost:3306 |
| Redis | localhost:6379 |

## База данных

```
Host:     mysql
Database: boxstore
User:     boxstore
Password: secret
```

## Artisan

```bash
docker exec boxstore_app php artisan <команда>
```