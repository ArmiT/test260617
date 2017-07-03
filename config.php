<?
// Параметры подключения к базе данных
define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DB", "book");
define("CHARSET", "utf8");

// Соединяемся с сервером базы данных
@$db = mysqli_connect(HOST, USER, PASS, DB);

// Проверки на ошибки соединения
if (mysqli_connect_errno()) {
	printf("Не удалось подключиться: %s\n", mysqli_connect_error());
	exit();
}

if (!mysqli_set_charset($db, CHARSET)) {
	printf("Не удалось изменить кодировку: %s\n", mysqli_error($db));
	exit();
}

// Выполняет запрос к базе данных
function rawQuery($query) {
	global $db;
	
	if (!$res = mysqli_query($db, $query))
		echo mysqli_error($db);
	
	return $res;
}

// Запрашивает сообщения из БД
function getMessage($page, $type = 'user') {
	
	$data = array(); // массив для хранения сообщений
	
	$page = ($page - 1)*10; // подготавливаем номер старницы для запроса к БД
	
	// type = 'user' - режим пользователя, вытаскивает 10 одобренных сообщений согласно номеру странице
	// type = 'admin' - режим админа, вытаскивает все сообщения, требующие модерации
	if ($type == 'user')
		$query = "SELECT * FROM guest WHERE hide='show' ORDER BY puttime DESC LIMIT $page,10";
	else
		$query = "SELECT * FROM guest WHERE hide='hide' ORDER BY puttime DESC";
	
	if ($res = rawQuery($query)) {
		while ($row = mysqli_fetch_assoc($res)) {
			$data[] = $row;
		}
		mysqli_free_result($res);// удаление выборки 
		return $data;
	} else {
		echo 'Ошибка соединения с базой данных';
		return false;
	}
}

// возвращает количество страниц
function numberPages() {
	$query = "SELECT id_msg FROM guest WHERE hide='show'";
	$number = ceil(mysqli_num_rows(rawQuery($query))/10);
	if ($number == 0) $number = 1;
	return $number;
}

// Записывает сообщение в базу данных
function insertMessage($name, $msg, $email, $city, $url) {
	$query = "INSERT INTO guest (name,city,email,url,msg,puttime,hide) VALUES ('$name','$city','$email','$url','$msg',NOW(),'hide')";
	return rawQuery($query);
}

// удаляет сообщение
function deleteMessang($id){
	$query = "DELETE FROM guest WHERE id_msg='$id'";
	return rawQuery($query);
}

// делает сообщение одобренным
function showMessang($id){
	$query = "UPDATE guest SET hide='show' WHERE id_msg='$id'";
	return rawQuery($query);
}

// Дает корректный ответ ошибки 404
function ErrorPage404() {
	$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
	header('HTTP/1.1 404 Not Found');
	header("Status: 404 Not Found");
	include "views/404.php";
}

// возвращает массив с номерами страниц
// $page - текущая страница;
// $end - всего страниц;
function paginator($page, $end) {
	
	$data = array(); // хранит номера страниц
	
	// во вложенном массиве $data[] = array(1,1) первое значение хранит название ссылки, а второе используется для оформления стилей и означают:
	// 1 - ссылка на другую страницу
	// 2 - текущая страница
	// 3 - троеточие
	
	if ($end == 1) {
		// запрет показа блока страниц
		return null;
	} elseif ($end <= 7) {
		//выводим все страницы
		for($i = 1; $i <= $end; $i++) {
				if ($i == $page)
					$data[] = array($i,2);
				else
					$data[] = array($i,1);
		}
	} else {
		//подбираем ссылки на страницы до текущей
		if ($page <= 4) {
			for($i = 1; $i < $page; $i++) {
				$data[] = array($i,1);
			}
		} else {
			$data[] = array(1,1);
			$data[] = array('...',3);
			for($i = $page - 2; $i < $page; $i++) {
				$data[] = array($i,1);
			}
		}
		
		//ссылка на текущую страницу
		$data[] = array($page,2);
		
		//подбираем ссылки на страницы после текущей
		if (($end - $page + 1) <= 4) {
			for($i = $page + 1; $i <= $end; $i++) {
				$data[] = array($i,1);
			}
		} else {
			for($i = $page + 1; $i <= $page + 2; $i++) {
				$data[] = array($i,1);
			}
			$data[] = array('...',3);
			$data[] = array($end,1);
		}
	}
	return $data;
}

// обрабатывает тэги сообщений
function tags($text) {
	$search = array('[u]','[i]','[b]','[sub]','[sup]','[/u]','[/i]','[/b]','[/sub]','[/sup]');
	$replace = array('<u>','<i>','<b>','<sub>','<sup>','</u>','</i>','</b>','</sub>','</sup>');
	$text = str_ireplace($search, $replace, $text);
	return $text;
}

// вырезает мат
function censor($text) {
	$search = array("#хуй#ius","#ёб#ius","#сука#ius","#суки#ius","#дроч#ius","#хуя#ius","#ссуч#ius","#пизд#ius");
	$text = preg_replace($search, '*', $text);
	return $text;
}
