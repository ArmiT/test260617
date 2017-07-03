<?
include "config.php";

// Проверка на переадресацию с ошибкой 404
if (!empty($_GET['err'])) {
	ErrorPage404();
	exit;
}

##############################################
#                                            #
#  БЛОК ПРИЕМА И ОБРАБОТКИ НОВОГО СООБЩЕНИЯ  #
#                                            #
##############################################

//массив для хранения ошибок
$errors = array();

// Массив для хранения данных, введенных в форму
	$data_form = array (
		'name' => '',
		'msg' => '',
		'email' => '',
		'city' => '',
		'url' => '',
	);
if (!empty($_POST)) {
	// принимаем переменные
	if (!$msg = trim(mysql_escape_string(htmlspecialchars($_POST['msg'])))) {
		$msg = '';
		$errors[] = 'Вы не ввели сообщение.';
	} elseif (strlen($msg) > 512) {
		$errors[] = 'Превышен максимальный лимит символов сообщения (512)';
	}

	if (!$name = trim(mysql_escape_string(htmlspecialchars($_POST['name'])))) {
		$name = '';
		$errors[] = 'Вы не ввели имя.';
	} elseif (strlen($name) > 255) {
		$errors[] = 'Превышен максимальный лимит символов имени (255)';
	}

	if (!$email = trim(mysql_escape_string(htmlspecialchars($_POST['email']))))
		$email = '';

	if (!$city = trim(mysql_escape_string(htmlspecialchars($_POST['city']))))
		$city = '';

	if (!$url = strtolower(trim(mysql_escape_string(htmlspecialchars($_POST['url'])))))
		$url = '';

	// При помощи регулярных выражений проверяем правильность ввода e-mail
	if(!empty($email)) {
		if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $email)) {
			$action = "";
			$errors[] = 'Неверно введен е-mail.&nbsp Введите e-mail в виде <i>something@server.com</i>.';
		}
	}

	// Добавляем протокол в url, если пользователь забыл это сделать сам
	if (!empty($url)) {
		if ((substr($url, 0, 7) != "http://") && (substr($url, 0, 8) != "https://"))
			$url = "http://".$url;
	}

	// Поверхностная защита от мата
	$msg = censor($msg);
	$name = censor($name);
	$city = censor($city);
	
	// обработка тэгов в сообщении
	$msg = tags($msg);

	// заполняем массив введенных в форму данных, чтобы передать их представлению страницы (/views/main.php)
	$data_form = array (
			'name' => $name,
			'msg' => $msg,
			'email' => $email,
			'city' => $city,
			'url' => $url,
		);

	if (empty($errors)) {
		insertMessage($name, $msg, $email, $city, $url);
		$data_form['msg'] = ''; // поскольку ошибок нет, поле ввода сообщения оставляем пустой (готовой к новому сообщению)
	}
}

####################################
#                                  #
#  БЛОК ВЫВОДА СТРАНИЦЫ СООБЩЕНИЙ  #
#                                  #
####################################


if (empty($_GET['page'])) $page = 1; // если номер страницы не передан, то выводим 1-ую
else $page = intval($_GET['page']);

if (($page < 0) || ($page > numberPages())) // проверка запращивоемой страницы на существование
{
	ErrorPage404();
	exit;
}

$data_messeges = getMessage($page); // загружаем сообщения страницы
$data_pages = paginator($page, numberPages()); // загружаем номера страниц для блока навигации (paginator)

// загружаем представление, в которое передается четыре массива с данными:
// $data_messeges
// $data_pages
// $data_form
// $errors
include "views/main.php";