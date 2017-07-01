<?php
		if (isset($_GET['id'])&isset($_GET['page'])) 
		{
			$id= $_GET['id'];
			echo $id;
			require_once 'connection.php'; // подключаем скрипт
			// подключаемся к серверу
			$link = mysqli_connect($host, $user, $password, $database)
			or die("Ошибка " . mysqli_error($link));
			$admission = 1;
			$sql =  "UPDATE   people   SET  admission='$admission' WHERE id='$id'";
			$sql = mysqli_query($link,$sql) or die(mysqli_error($link));
			/*if ($sql) {
				echo "$login";
			} else {
				echo "$login не";
			}*/
			// закрываем подключение
			mysqli_close($link);
			$page =   $_GET['page'];
			echo $page;
			echo "<meta http-equiv='refresh' content='0; url=admin.php?page=1'>";
		}
?>
