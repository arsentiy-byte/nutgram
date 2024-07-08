# API Документация Swagger

> Используется библиотека [L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger)
> 
> Конфиги в файле [l5-swagger.php](../config/l5-swagger.php)
> 
> Базовый класс контроллера в [Controller](../app/Http/Controllers/Controller.php)
>
> UI документации доступен по пути http://blog.localhost/api/documentation
>
> JSON файл доступен по пути http://blog.localhost/docs/api-docs.json
>
> Сама документация генерируется в директории [storage/api-docs/api-docs.json](../storage/api-docs/api-docs.json)

Для генерации документации используется команда:

```shell
php artisan l5-swagger:generate
```

или

```shell
make swagger
```
