<html>
<head>
<title>Гостевая книга</title>

	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/stylesHead.css">
</head>
<body>
		<div id="header">
			<div id="block1"><br></div>
			<div id="block2">ГОСТЕВАЯ КНИГА: _НОВАЯ ЗАПИСЬ_</div>
			<div id="block1"><div id="button"><a href="adminAt.php?back=index" title="Администратор"><img src="img/crown.png" alt="Админ"></a></div></div>
		</div>
		<div id="main">
		Чтобы добавить свою запись в гостевую книгу, заполните форму...
		</div>
		<div>
		<form  method="POST" enctype="multipart/form-data">
			<div id="std">
				<div id="clmn">Имя:</div>
				<div id="clmnT"><input type='text' name='login' value=''></div>
			</div>
			<div id="std">
				<div id="clmn">E-mail:</div>
				<div id="clmnT"><input type='text' name='email' value=''></div>
			</div>
			<div id="std">
				<div id="clmn">Сообщение:</div><div id="clmnT"><textarea name="message" rows="4" cols="55" wrap="virtual"></textarea></div>
			</div>
			<div id="std">
				<div id="clmn"></div><div id="clmnT"><INPUT type=SUBMIT VALUE=Отправить><INPUT type="reset" VALUE=Отменить></div>
			</div>
		</form>
		</div>


		<!--action="chat.php"-->


		<div id="message">
			<div id="all">
				<!-- ИМЯ -->
				<?php
				if (isset($_POST['message']) & isset($_POST['email'])& isset($_POST['login'])) {
				require_once 'connection.php'; // подключаем скрипт

				// подключаемся к серверу
				$link = mysqli_connect($host, $user, $password, $database)
				or die("Ошибка " . mysqli_error($link));

				// выполняем операции с базой данных
				$login = "Не известно";
				$email = "Не известно";
				$message = "Не известно";
				$admission = 0;
				if(isset($_POST['login'])) $login =  $_POST['login'];
				if (isset($_POST['email'])) $email =  $_POST['email'];
				if (isset($_POST['message'])) $message =  $_POST['message'];
				if (isset($_POST['message']) & isset($_POST['email'])& isset($_POST['login']))
					$sql =  "INSERT INTO people (name,email,message,admission) VALUES ('$login','$email','$message','$admission')";
				$sql = mysqli_query($link,$sql) or die(mysqli_error($link));
				if ($sql) {
					echo "$login";
				} else {
					echo "$login не";
				}
				//var_dump($sql);
				// закрываем подключение
				mysqli_close($link);
				///echo "$login";
				}
				?>
				<!-- ОТПРАВИЛ(А) СООБЩЕНИЕ:-->
			</div>
			<div id="cclmn">
				<div id="cclmn2">
					<?php
					if (isset($_POST['message']) & isset($_POST['email'])& isset($_POST['login'])) {echo "оставил(а) запись:";}
					?>
				</div>
			</div>
			<div id="cclmnT">
				<!-- СООБЩЕНИЕ-->
				<?php
				if (isset($_POST['message']) & isset($_POST['email'])& isset($_POST['login'])) {
					$message = "Не известно";
					if (isset($_POST['message'])) $message = $_POST['message'];
					echo "$message";
				}
				?>
			</div>
		</div>
		<div id="main">
			Чтобы посмотреть другие записи, нажмите...
		</div>
		<!--<form action="chat.php?page=1" method="POST" enctype="multipart/form-data">
			<div id="std">
				<div id="clmn"></div><div id="clmnT"><INPUT type=SUBMIT  VALUE="Посмотреть записи"</div>
			</div>
		</form>-->
		<div id="header"><div id="head"><a href="chat.php?page=1">Посмотреть записи</a></div></div>
</body>
</html>