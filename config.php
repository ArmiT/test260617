<?php

	// название  сервера БД
	define ('HOST', 'localhost');
	// название базы данных
	define ('DATABASE', 'db');
	// пользователь MySQL
	define ('MYSQL_USER', 'root');
	// пароль к MYSQL
	define ('MYSQL_PASS', '');

// Подключение к БД
$link1 = mysqli_connect(HOST, MYSQL_USER, MYSQL_PASS) or die("Ошибка подключения к БД");
    
// Выбор БД
mysqli_select_db($link1, DATABASE) or die("Указанной базы данных не существует или недостаточно прав доступа");


?>
