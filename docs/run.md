# Запуск приложения локально для работы с Telegram Bot API

## В режиме Webhook
> Используется [Expose](https://expose.dev/) - expose local sites via secure tunnels
>
> Открывается публичный доступ к локальному приложению и регистрируется **webhook** для Telegram Bot API

**Инструкция**:

1. Регистрируемся на сайте [expose.dev](https://expose.dev/)
2. Установка Expose на локальную среду: `composer global require beyondcode/expose`
3. Аутентификация для expose: `expose token {{token}}` - **token** генерирует сам Expose
4. Открываем доступ: `expose share http://localhost`
5. Выполняем команду `make set-webhook host={host}` - напр: `make set-webhook host=https://nutgram.com`

## В режиме Polling
> Используется Polling метод - приложение идет в Telegram Bot API сам и получает обновления

Для этого выполняем команду `make polling` 
