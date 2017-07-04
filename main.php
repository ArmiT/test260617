<?php
	require_once ('settings.php');
	require_once ('db.php');
	require_once ('design.php');
	
	//Коннект
	$link = mysqli_connect(DBHOST, DBUSER, DBPASSWD, DBNAME) or die('Could not connect to database');
	mysqli_select_db($link, DBNAME) or die('Could not select database');
 
	//Создание таблицы, если её нет
	gb_install($link);
 
 // получаем данные формы, если форма была отправлена
	if (!empty($_POST['msg_submit'])) {
		$name = @$_POST['name'];
		$email = @$_POST['email'];
		$message = @$_POST['message'];
	}
	else {
		$name = $email = $message = '';
	}

	// если в GET-запросе не указан номер страницы, выводим первую
	if(is_numeric(@$_GET['page']))
		$page = $_GET['page'];
	else
		$page = 1;
		
	// если нужно добавить запись, добавляем
	if(@$_GET['add'])
		gb_add($link, $name, $email, $message);
    
	// если нужно удалить запись, удаляем
	if(isset($_GET['del']) && auth_is_admin()) {
		gb_delete($link, intval($_GET['del']));
	}
	
	// если нужно одобрить запись, одобряем
	if(isset($_GET['approve']) && auth_is_admin()) {
		gb_approve($link, intval($_GET['approve']));
	}

	// Вывод списка страниц
	function gb_paginator($link, $current, $admin){
		
        // узнаем число записей в гостевой книге
		if ($admin) {
			$result = mysqli_query($link, 'SELECT * FROM `gb`');
		}
		else {
			$result = mysqli_query($link, 'SELECT * FROM `gb` WHERE `approved` = 1');
		}
		
		$rows = mysqli_num_rows($result);
		if($rows)
		{
			$pages = ceil($rows / RECORDSPERPAGE);

			// печатаем ссылки на страницы (номер текущей страницы не является ссылкой)
			echo '<div class=c>';
			for($i = 1; $i <= $pages; $i++)
			{
				if($i != $current){
					echo (' | <a href=' . PATH . '?page=' . $i);
					if (auth_is_admin()) {
						echo ('&admin=1');
					}
					echo ('>' . $i . '</a>');
				}
				else
					echo (' | ' . $i);
			}
			echo ' |';

			// если это не поcледняя страница печатаем ссылку "Дальше"
			if($current < $pages) {
				echo (' <a href=' . PATH . '?page=' . ($current + 1));
				if (auth_is_admin()) {
					echo ('&admin=1');
				}
				echo('> Дальше &gt;&gt; ' . '</a>');
			}
			echo '</div>';
		}
	}
	
	// вывод страницы с записями
	function gb_show($link, $page, $admin){
		// положение первой записи страницы
		$begin = ($page - 1) * 10;
		// выборка записей из базы данных
		if ($admin) {
			$result = mysqli_query($link, 'SELECT * FROM `gb` ORDER BY datetime DESC LIMIT ' . $begin . ', ' . RECORDSPERPAGE);
		}
		else {
			$result = mysqli_query($link, 'SELECT * FROM `gb` WHERE `approved` = 1 ORDER BY datetime DESC LIMIT ' . $begin . ', ' . RECORDSPERPAGE);
		}

		// цикл по всем выбранным записям
		while($row = mysqli_fetch_array($result))
			gb_showone($row['id'], $row['name'], $row['email'], $row['message'], $row['datetime'], $row['approved']);

		// уничтожаем результат в памяти
		mysqli_free_result($result);
	}
	
	function gb_auth($page){
		if (auth_is_admin()) {
			echo('<center><form action="' . PATH . '?page =' . $page . '" method=get> <button class="btn btn-danger" type= "submit" name="admin" value = 0> Перейти в режим пользователя</button></form></center>');
		}
		else {
			echo('<center><form action="' . PATH . '?page =' . $page . '" method=get> <button class="btn btn-danger" type= "submit" name="admin" value = 1> Перейти в режим администратора</button></form></center>');
		}
	}

	// печатаем гостевую книгу
	gb_header($page);
	gb_form($name, $email, $message);
	gb_paginator($link, $page, auth_is_admin());
	gb_show($link, $page, auth_is_admin());
	gb_paginator($link, $page, auth_is_admin());
    gb_auth($page);
?>