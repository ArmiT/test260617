# test260617

## Краткое описание

Приложение "Гостевая книга" с возможностью добавления сообщений посетителями ресурса путем ввода данных в форму.
Публичная часть:
- Доступ всем пользователям без ограничений (без аутентификации) путем обращения по базовому адресу ресурса.
- Возможность добавления комментария, путем ввода следующих полей: "Сообщение", "Имя автора", "E-mail автора".
- Ограничение размера вводимого текста 512 символами.
- Ограничение размера имени автора 255 символами.
- Возможность просмотра существующих одобренных сообщений путем вывода списка отсортированного
 в порядке убывания даты добавления записи. (т.е. свежие в начале).
- Разбиение общего списка сообщений на страницы по 10 шт. на каждой.
- Вывод навигации по страницам под списком.
- Корректная обработка (возврат 404) в случае запроса несуществующей страницы.

Система администрирования:
- Вывод списка добавленных сообщений, нуждающихся в модерации.
- Возможность удалить сообщение путем нажатия соотв. ссылки
- Возможность одобрения сообщения, в результате которого оно начнет попадать в список публичной части приложения.

## Используемое ПО и библиотеки
### Серверная часть
1. PHP 7.x
2. MySQL Server 5.x
3. Apache v2.4

### Клиентская часть
1. HTML5
2. CSS3
3. Bootstrap v3.3
4. JQuery 3.x

## Иерархия файлов
Исходные файлы проекта разбиты на категории, соответствующие типам файлов: файлы страниц, скрипты сервера, скрипты клиента, и т.д. Файлы могут быть неполными, т.к. являются шаблонами или частями конечных файлов, получаемых после сборки.

После сборки проекта иерархия имеет отличный вид, описанный ниже.

Скрипт [*db.sql*](_src/db.sql) отражает структуру БД.

## Сборка проекта (Gulp)
Для сборки используется Gulp. Плагины:
- gulp-minify-html (сжатие HTML)
- gulp-concat (склейка файлов)
- gulp-uglify (сжатие JS)
- gulp-sass (SASS)

Файлы страниц публичной части и администрирования собираются соединением файлов header.html, тела страницы и footer.html. Файлы скриптов для каждой части - соединение общей функциональности (shared.js) и скриптов части (admin.js или public.js). Таблицы стилей создаются аналогично.

Перед сборкой в папку *_src/php* требуется вложить файл *db_conf.dsf* с данными для подключения к БД, имеющий следующий вид:
```
<?php
$host = "localhost";        // Адрес MySQL Server
$user = "username";         // Имя пользователя БД
$pass = "password";         // Пароль
$dbname = "twins_practice"; // Выбор схемы БД
?>
```

#### После сборки корень проекта находится в папке *build*.

## Тестирование
Проект можно протестировать по следующим ссылкам:
- [Публичная часть](http://test.energet.xyz/public.php)
- [Администрирование](http://test.energet.xyz/admin.php)
