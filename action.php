<?php
error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
	include ("dbconnect.php");

	// получаем переменные из формы
	$username=$_REQUEST['username'];
	$msg=$_REQUEST['msg'];
	$action=$_REQUEST['action'];
	
	if ($action=="add")
	{
		// добавление данных в БД 
		$sql="INSERT INTO gb(username, dt, msg) VALUES ('$username', NOW(), '$msg')";
		$r=mysql_query ($sql);
	}
	
	if ($action=="delete")
	{
		// удаление базы гостевой
		$sql="DELETE FROM gb";
		$r=mysql_query($sql);
	}
	
	header("Location: index.php");
?>