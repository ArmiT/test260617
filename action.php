<?php
	include ("dbconnect.php");

	// получаем переменные из формы
	$username=$_REQUEST['username'];
	$msg=$_REQUEST['msg'];
	$action=$_REQUEST['action'];
	
	if ($action=="add")
	{
		// добавление данных в БД 
		$sql="INSERT INTO gb(username, dt, msg) VALUES ('$username', NOW(), '$msg')";
		$r=mysqli_query ($link1, $sql);
	}
	
	if ($action=="delete")
	{
		// удаление базы гостевой
		$sql="DELETE FROM gb";
		$r=mysqli_query($link1, $sql);
	}
	
	header("Location: index.php");
?>