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
				<div id="clmnT"><input type='text' name='login' value='' placeholder="Введите свое имя" required pattern="^[а-яА-ЯёЁa-zA-Z0-9_.]{1,255}$" maxlength="255"></div>
			</div>
			<div id="std">
				<div id="clmn">E-mail:</div>
				<div id="clmnT"><input type='email' name='email' value='' placeholder="Введите свой e-mail" required maxlength="50"></div>//
			</div>
			<div id="std">
				<div id="clmn">Сообщение:</div><div id="clmnT"><textarea name="message" rows="4" cols="55" wrap="virtual" placeholder="Введите текст новой записи" required
																		 maxlength="512"></textarea></div>

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
				if (isset($_POST['message']) & isset($_POST['email'])& isset($_POST['login']))
				{
					$admission = 0;
					$login =  $_POST['login'];
					$email =  $_POST['email'];
					$message =  $_POST['message'];
					$error=0;
					require_once 'falidation.php'; // подключаем проверку
					If ($error!=0)
					{
						If ($error==4)
						{
							require_once 'connection.php'; // подключаем скрипт

							// подключаемся к серверу
							$link = mysqli_connect($host, $user, $password, $database)
							or die("Ошибка " . mysqli_error($link));

							// выполняем операции с базой данных
							if (isset($_POST['message']) & isset($_POST['email'])& isset($_POST['login']))
								$sql =  "INSERT INTO people (name,email,message,admission) VALUES ('$login','$email','$message','$admission')";
							$sql = mysqli_query($link,$sql) or die(mysqli_error($link));
							if ($sql) {
								echo "$login";
							} else {
								echo "$login не";
							}

							// закрываем подключение
							mysqli_close($link);
						}
						If ($error==1){echo "Неверное имя. Оно может содержать лишь буквы и символы \"_\" и \".\". Его размер не должен превышать 255 символов, и имя не должно быть пустым.";}
						If ($error==2){echo "Неверный адрес электронной почты. 
						Он не может содержать русских букв и должен содержать как минимум 2 любых символа и символ  \"@\" меду ними. 
						Его размер не должен превышать 50 символов";}
						If ($error==3){echo "Неверно введено сообщение. Его размер не должен превышать 512 символов, и оно не должно быть пустым.";}
						If (($error!=1)&($error!=2)&($error!=3)&($error!=4)) {echo "Произошла ошибка. Попытайтесь снова.";}
					}
				}
				?>
			</div>
			<!-- ОТПРАВИЛ(А) СООБЩЕНИЕ:-->
			<div id="cclmn">
				<div id="cclmn2">
					<?php
					if (isset($_POST['message']) & isset($_POST['email'])& isset($_POST['login'])&($error==4)) {echo "оставил(а) запись:";}
					?>
				</div>
			</div>
			<!-- СООБЩЕНИЕ-->
			<div id="cclmnT">
				<?php
				if (isset($_POST['message']) & isset($_POST['email'])& isset($_POST['login'])&($error==4)) {
					$message = $_POST['message'];
					echo "$message";
				}
				?>
			</div>
		</div>
		<div id="main">
			Чтобы посмотреть другие записи, нажмите...
		</div>
		<?php
		require_once 'link.php'; //$_GET['page'] & $_GET['sort']
		echo '<div id="header"><div id="head"><a href="chat.php?page='.$page.'&sort='.$sort.'">все записи</a></div></div>';
		?>
</body>
</html>