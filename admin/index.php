<?
// загружаем все функции и подключаемся к БД
include "../config.php";

//улавливаем команду на удаление сообщения
$delete = intval($_GET['delete']);
if (!empty($delete))
	deleteMessang(intval($_GET['delete']));

//улавливаем команду на одобрение сообщения
$show = intval($_GET['show']);
if (!empty($show))
	showMessang(intval($_GET['show']));

// загружаем сообщения
$data_messeges = getMessage($page, 'admin');

// загружаем представление, в которое передается два массива с данными:
// $data_messeges
// $data_pages
include "view.php";

?>