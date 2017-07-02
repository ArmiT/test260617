<html>
<head>
<title>Гостевая книга</title>
	<link rel="stylesheet" type="text/css" href="css/stylesAdAt.css">
	<link rel="stylesheet" type="text/css" href="css/stylesHead.css">
</head>
<body>
<?php
$loginTrue = "admin";
$passwordTrue  = "1234";
?>
	<div id="header">
		<div id="block1"><br></div>
		<!--<div id="block2">ГОСТЕВАЯ КНИГА:<div id="head"> _АУТЕНТИФИКАЦИЯ АДМИНИСТРАТОРА_</div></div>-->
		<div id="block2">_АУТЕНТИФИКАЦИЯ АДМИНИСТРАТОРА_</div>
		<div id="block1"><div id="button">
			<?php
			if (isset($_GET['back'])) $back =   $_GET['back'];
			if ($back=="" ) $back="index"; 
			if ($back=="index")echo '<a href="'.$back.'.php" title="Назад"><img src="img/back.png" alt="Назад"></a>';
			if ($back=="chat")
			{
				require_once 'link.php'; //$_GET['page'] & $_GET['sort']
				echo '<a href="'.$back.'.php?page='.$page.'&sort='.$sort.'" title="Назад"><img src="img/back.png" alt="Назад"></a>';
			}
			?>
		</div></div>		
	</div>
	<div id="main">
		Чтобы зайти в качестве администратора, заполните форму...
	</div>
	<div>
		<form  method="POST" enctype="multipart/form-data">
			<div id="std">
				<div id="clmn">Логин:</div>
				<div id="clmnT"><input type='text' name='login' value=""></div>
			</div>
			<div id="std">
				<div id="clmn">Пароль:</div>
				<div id="clmnT"><input type='text' name='password' value=""></div>
			</div>
			<div id="std">
				<div id="clmn"></div>
				<div id="clmnT"><INPUT type=SUBMIT VALUE=Отправить><INPUT type="reset" VALUE=Отменить></div>
			</div>
		</form>
	</div>
	<div id="message">
		<div id="alll"> 
			<?php
			$login = "Не известно";
			$password = "Не известно";
			if (isset($_POST['login']) & isset($_POST['password']))
			{

				$login =  $_POST['login'];
				if  ($login=="")
				{
					echo "Не все поля заполнены! Повторите ввод!";
				}
				else
				{
					$password =  $_POST['password'];
					if  ($password=="")
					{
						echo "Не все поля заполнены! Повторите ввод!";
					}
					else
					{
						//проверка соответствуют ли введеные данные истинным
						if  ($login!=$loginTrue | $password!=$passwordTrue)
						{
							echo "Не все поля заполнены верно. Доступ запрещен! Попробуйте снова!";
						}
						else
						{
							/*if  ($login==$loginTrue)
							{
								if  ($password==$passwordTrue){
									//Все верно
									echo "Все ок!";
								}
								else
								{
									//неверный пароль, а логин верный
									echo "Неверный пароль! Попробуйте снова!";
								}
							}
							else
							{
								//неверный логин
								echo "Неверный логин! Попробуйте снова!";
							}*/
							echo "<meta http-equiv='refresh' content='0; url=admin.php?page=1&sort=0'>";
						}
					}
				}
			}
			/*else
			{
				echo "Ошибка! Данные не отправлены!";
			}*/
			?>
		</div>
	</div>
</body>
</html>
