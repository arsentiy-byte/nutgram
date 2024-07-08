# Линтеры

## Laravel Pint для форматирования и стандартизации кода

> Используется библиотека [Laravel Pint](https://laravel.com/docs/11.x/pint)
> Конфигурация в [pint.json](../pint.json)

- Для проверки кода запускается команда:
```shell
vendor/bin/pint --test --dirty --config pint.json
```

Или

```shell
make pint-test
```

- Для форматирования кода:
```shell
vendor/bin/pint --config pint.json
```

Или

```shell
make pint
```

## Анализатор кода
> Используется библиотека [PHPStan](https://phpstan.org/)
> Конфигурация в [phpstan.neon](../phpstan.neon)

- Для запуска анализатора используется команда:
```shell
vendor/bin/phpstan analyse -c phpstan.neon
```

Или

```shell
make phpstan
```
