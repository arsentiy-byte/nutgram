# Сборка и запуск

В проекте поднимаются следующие сервисы:
- **php** - Основное приложение
- **nginx** - Прокси-сервер на nginx
- **database** - База данных на движке PostgreSQL
- **redis** - Redis: кэш, БД, брокер сообщений
- **scheduler** - Scheduler для запуска задач по расписанию
- **worker** - Запуск Laravel Horizon

> Описание сервисов в [docker-compose.yml](../docker-compose.yml)

> Образ самого приложение в [Dockerfile](../docker/php/Dockerfile)

> Конфигурация прокси-сервера в [nginx.conf](../docker/nginx-rf/site.conf)

> Все команды прописаны в [Makefile](../Makefile)
- Сборка проекта:

```shell
make build
```

- Запуск проекта
```shell
make up
```

- Сборка и запуск
```shell
make build-and-up
```
