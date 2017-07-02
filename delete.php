<?php
	if (isset($_GET['id']))
	{
		$id= $_GET['id'];
		require_once 'connection.php'; // подключаем скрипт
		// подключаемся к серверу
		$link = mysqli_connect($host, $user, $password, $database)
		or die("Ошибка " . mysqli_error($link));
		$admission = 1;
		$sql =  "DELETE FROM   people    WHERE id='$id'";
		$sql = mysqli_query($link,$sql) or die(mysqli_error($link));
	
		// закрываем подключение
		mysqli_close($link);
		
		require_once 'link.php'; //$_GET['page'] & $_GET['sort']
		echo "<meta http-equiv='refresh' content='0; url=admin.php?page=".$page."&sort=".$sort."'>";
	}
?>
