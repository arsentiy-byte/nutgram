# Тесты

> Используется стандартная библиотека [PHPUnit](https://phpunit.de/index.html)
> 
> Конфигурация в файле [phpunit.xml](../phpunit.xml)
> 
> Unit тесты в директории [Unit](../tests/Unit)
> Feature тесты в директории [Feature](../tests/Feature)
> 
> Так же применяются проверки и подготовка тестов к запуску (логика описана в трейте [CreatesApplication](../tests/CreatesApplication.php)).
> 
> Базовый класс тестов в [TestCase](../tests/TestCase.php)

Для запуска тестов используется следующая команда:

```shell
vendor/bin/phpunit
```

или

```shell
make test
```
