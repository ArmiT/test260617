<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<title>Гостевая книга</title>
		<link rel="stylesheet" href="style.css">
	</head>
	
<?php

require_once "config.php";


$uname = $_POST['uname'];
$uemail = $_POST['uemail'];
$ucomment = $_POST['ucomment'];

//Защита от некорректного воода
$uname = strip_tags($uname);
$uname = HtmlSpecialChars($uname);
$uname = mysqli_real_escape_string($link1, $uname);

$ucomment = strip_tags($ucomment);
$ucomment = HtmlSpecialChars($ucomment);
$ucomment = mysqli_real_escape_string($link1, $ucomment);
	
if (strlen($uname)==0) $uname = 'Гость';
if (strlen($uemail) == 0) die("Вы не ввели E-mail!<br><a href=index.php>Назад</a>");
	
if ((strlen($ucomment) == 0) or (strlen($ucomment) > 512)) die("Вы не ввели текст или превысили допустимый порог<br><a href=index.php>Назад</a>");
	
$q = "INSERT INTO book values (0, \"$uname\", \"$uemail\", \"$ucomment\", 0, CURDATE() )";

mysqli_query($link1, $q) or die('Ошибка при вставке');

$ID = mysqli_insert_id($link1);

echo "<p>Ваш отзыв был успешно добавлен. Пока администартор не одобрит Ваше объявления, оно не появится.<br><a href=index.php> Вернуться назад</a></p>";

?>