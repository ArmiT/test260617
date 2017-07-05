<?php

// подключаем модули
require_once 'my/defines.php';
require_once 'my/template.php';
require_once 'engine/gb.php';
require_once 'engine/lib/auth.php';
require_once 'engine/lib/strings.php';


// подключаемся к БД
db_connect(DBHOST, DBUSER, DBPASSWD, DBNAME);

// создаём таблицу, если её нет
gb_install();

// получаем данные формы, если форма была отправлена
if (!empty($_POST['sb']))
{
	$name = @$_POST['name'];
	$email = @$_POST['email'];
	$message = @$_POST['message'];
	$formerr = '';
}
else
{
	$name = $email = $message = $formerr = '';
}

// если в GET-запросе не указан номер страницы, выводим первую
if(is_numeric(@$_GET['page']))
  $page = $_GET['page'];
else
  $page = 1;

// если нужно добавить запись, добавляем
if(@$_GET['add'])
  gb_add($name, $email, $message, $formerr);

// если нужно удалить запись, удаляем
if(isset($_GET['del']) && auth_is_admin())
  gb_delete(intval($_GET['del']));

// печатаем гостевую книгу
template_header($page);
gb_showpages($page);
gb_show($page);
gb_showpages($page);
template_form($name, $email, $message, $formerr);
template_footer();


?>