<?php
	//Создание таблицы, если её нет
	function gb_install($link) {
		mysqli_query($link,
		"CREATE TABLE IF NOT EXISTS `gb` (
		`id` int(10) unsigned NOT NULL auto_increment,
		`datetime` datetime NOT NULL,
		`name` varchar(255) NOT NULL default '',
		`email` varchar(129) default '',
		`message` text(512) NOT NULL,
		`approved` bit(1) NULL DEFAULT 0,
		PRIMARY KEY (id)
		);")  or die('Query failed: ' . mysqli_error($link));
	};
	
	// Функция аутентификации
	function auth_is_admin() {
		return @$_GET['admin'];
	}
	
	// Функция чистки строки
	function strings_clear($string) {
		return htmlspecialchars(stripslashes(trim($string)), ENT_QUOTES);
	}
	
	// Функция добавления записи
	function gb_add($link, $name, $email, $message){
		// если не было ошибок -- добавляем
		if(!empty($name) && !empty($message) && !empty(filter_var($email, FILTER_VALIDATE_EMAIL))){
			// чистим данные
			// echo('one');
			$name = substr(strings_clear($name), 0, 255);
			$email = substr($email, 0, 129);
			$message = nl2br(substr(strings_clear($message), 0, 512));

			// запрос на добавление записи в базу данных
			mysqli_query($link, 'INSERT INTO `gb` (name, email, message, datetime) VALUES("' . $name . '", "' . $email . '", "' . $message . '", NOW());') or die('Query failed: ' . mysqli_error($link));
			// перекидываем браузер на первую страницу, чтобы, если пользователь обновит страницу, запись не добавилась еще раз
			header('Location: ' . PATH . "?page=1");
		}
		else {
			$out = '';
			if (empty($name)) $out .= 'Пустое имя. ';
			if (empty($email)) $out .= 'Не указан почтовый адрес. ';
			if (empty($message)) $out .= 'Отсутствует текст сообщения. ';
			exit($out);
		}
	}
	
	// Функция удаления записи
	function gb_delete($link, $id){
		echo('one');
		// запрос на удаление записи из базы данных
		// WHERE id = '.$id указывает на запись, которую следует удалить
		mysqli_query($link, 'DELETE FROM `gb` WHERE `gb`.`id` = ' . $id) or die('Query failed: ' . mysqli_error($link));
		header('Location: '.PATH."?page=1&admin=1");
	}
	
	// Функция одобрения записи
	function gb_approve($link, $id) {
		mysqli_query($link, 'UPDATE `gb` SET `approved` = 1 WHERE `gb`.`id` = ' . $id) or die('Query failed: ' . mysqli_error($link));
	}
 ?>
