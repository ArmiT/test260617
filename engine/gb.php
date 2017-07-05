<?php
/**
*
* Основные функции гостевой книги
*
*/
/**
*
* Функции для работы с базой данных
*
*/

/** recource db_connect ( string host, string user, string passwd, string dbname )
* Подключение к СУБД и открытие базы данных
*/
function db_connect($host, $user, $passwd, $dbname)
{
	$link = mysqli_connect($host, $user, $passwd, $dbname) or die('Could not connect to database');
	mysqli_select_db($link, $dbname) or die('Could not select database');
	return $link;
}

/** Выполняет запрос к БД
*
* @param текст запроса
* @return resource id
*/
function db_query($link, $query)
{
	$result = mysqli_query($link, $query)
	  or die('Bad database query');
	return $result;
}

/** Выполняет запрос к БД (placeholder)
*
* @param текст запроса
* @param*
* @return resource id
*/
function db_query_ex($query)
{
	$values = func_get_args();
	array_shift($values);
	$i = 0;
$link = mysqli_connect("localhost","root", "","test");
	return db_query($link,preg_replace('%\?%e', '"\'".addslashes($values[$i++])."\'"', $query));
}



function gb_install()
{
$link = mysqli_connect("localhost","root", "","test");
	db_query($link,
		'CREATE TABLE IF NOT EXISTS gb (
			id int(10) unsigned NOT NULL auto_increment,
			datetime datetime NOT NULL default \'0000-00-00 00:00:00\',
			name varchar(100) NOT NULL default \'\',
			email varchar(100) default NULL,
			message text NOT NULL,
			PRIMARY KEY (id),
			INDEX (datetime)			
		) ENGINE=MyISAM;'
	);
}

/**
* Добавление записи в гостевую книгу
*/
function gb_add($name, $email, $message, &$error)
{
	// проверяем правильность заполнения полей
	$error = '';
	if(empty($name))
		$error['name'] = 'Это обязательное поле';
	if(empty($message))
		$error['message'] = 'Это обязательное поле';
	if(!empty($email) && !strings_isemail($email))
		$error['email'] = 'Это не email';

	// если не было ошибок -- добавляем
	if(!$error)
	{
		// чистим данные
		$name = strings_clear($name);
		$message = strings_clear($message);
		$name = strings_stripstring($name, 15, 100);
		$email = strings_stripstring($email, 100, 100);
		$message = strings_stripstring($message, 100, 2000);
		$message = nl2br($message);

		

		// запрос на добавление записи в базу данных
		db_query_ex('INSERT INTO gb (name, email, message, datetime) VALUES(?, ?, ?, ?, NOW())', $name, $email,  $message);
		// перекидываем браузер на первую страницу
		// это нужно, чтобы, если пользователь нажмет кнопку Refresh, запись не добавилась еще раз
		header('Location: '.PATH."?page=1");
	}
}

// удаление записи из гостевой книги
function gb_delete($id)
{
  // запрос на удаление записи из базы данных
  // WHERE id = '.$id указывает на запись, которую следует удалить
  db_query_ex('DELETE FROM gb WHERE id = ?', $id);
  header('Location: '.PATH."?page=1"); // ???
}

// вывод страницы с записями
function gb_show($page)
{
	// положение первой записи страницы
	$begin = ($page - 1) * 10;
	// выборка записей из базы данных
	// SELECT * FROM gb -- все поля из бд gb
	// ORDER BY datetime DESC -- сортировка по дате, новые сверху
	// LIMIT '.$begin.','.RECSPERPAGE -- ограничение: RECSPERPAGE (см. defines.php) записей начиная с $begin
$link = mysqli_connect("localhost","root", "","test");	
$result = db_query($link,'SELECT * FROM gb ORDER BY datetime DESC LIMIT '.$begin.', '.RECSPERPAGE);
	$out = '';

	// цикл по всем выбранным записям
	while($row = mysqli_fetch_array($result))
		$out .= template_show_body($row['id'], $row['name'], $row['email'], $row['message'], $row['datetime']);

	// уничтожаем результат
	mysqli_free_result($result);

	echo $out;
}

// вывод списка страниц
function gb_showpages($current)
{ 
$link = mysqli_connect("localhost","root", "","test");
	// узнаем число записей в гостевой книге
	$result = db_query($link,'SELECT * FROM gb');
	$rows = mysqli_num_rows($result);
	if($rows)
	{
		$pages = ceil($rows / RECSPERPAGE);

		// печатаем ссылки на страницы (номер текущей страницы не является ссылкой)
		echo '<div class=c>';
		for($i = 1; $i <= $pages; $i++)
		{
			if($i != $current)
				echo ' | <a href='.PATH.'?page='.$i.'>'.$i.'</a>';
			else
				echo ' | '.$i;
		}
		echo ' |';

		// если это не полследняя страница печатаем ссылку "Дальше"
		if($current < $pages)
			echo ' <a href='.PATH.'?page='.($current + 1).'>next &gt;&gt;</a>';
		echo '</div>';
	}
}

?>