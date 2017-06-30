<?php
	// название  сервера БД
	define ("HOST", "localhost");
	// название базы данных
	define ("DATABASE", "gb");
	// пользователь MySQL
	define ("MYSQL_USER", "root");
	// пароль к MYSQL
	define ("MYSQL_PASS", "");
	
	
	// создаем базу данных и таблицу  gb
	$link1=mysqli_connect(HOST, MYSQL_USER, MYSQL_PASS) or die("Нет соединения с MySQL сервером!");
	mysqli_query ($link1, "CREATE DATABASE IF NOT EXISTS ".DATABASE) or die ("Не могу создать базу данных gb.");
	mysqli_select_db($link1, DATABASE) or die("Нет содениения с требуемой базой данных!");
	mysqli_query ($link1, "CREATE TABLE IF NOT EXISTS gb (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, username VARCHAR (100), dt DATETIME, msg TEXT)") or die ("Не могу создать таблицу gb.");
?>