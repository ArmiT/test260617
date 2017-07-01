<html>
<head>
<title>Гостевая книга</title>
	<link rel="stylesheet" type="text/css" href="css/stylesCh.css">
	<link rel="stylesheet" type="text/css" href="css/stylesHead.css">
</head>
<body>
	<div id="header">
			<div id="block1"><br></div>
			<div id="block2">ГОСТЕВАЯ КНИГА: _ВСЕ ЗАПИСИ_</div>
			<div id="block1"><div id="button"><a href="adminAt.php?back=chat" title="Администратор"><img src="img/c.png" alt="Админ"></a></div></div>
	</div>
	<!--<div id="message">-->
		<?php
		require_once 'connection.php'; // подключаем скрипт

		// подключаемся к серверу
		$link = mysqli_connect($host, $user, $password, $database)
		or die("Ошибка " . mysqli_error($link));

		// Ограничиваем количество ссылок, которые будут выводиться перед и
		// после текущей страницы
		$limit=2;
		if (isset($_GET['page'])) $page =   $_GET['page'];
		//В любой непонятной ситуации выводи первую страницу
		if ($page<1) $page=1; if(!is_numeric($page)) $page=1;
		// !!!!!!!!!!!!!!!!!выполняем операции с базой данных
		$sql = " SELECT * FROM people ";
		$res = mysqli_query($link,$sql) or die(mysqli_error($link));

		$quantity=4;
		$num = mysqli_num_rows($res);
		// Округляем до целого (Кол-во записей в БД/ Кол-во записей на странице)
		$pages = ceil($num/$quantity);
		if ($pages<$num/$quantity) $pages++;
		//Ограничение сверху
		if ($page>$pages) $page = 1;

		// Текущая станица на черном фоне
		echo '<div id="header"><div id="head"><strong>- '.$page.' -</strong><br><div style="color: #83E5F8;">(  '.$page.' из '.$pages.' )</div></div></div>';
		
		// Переменная $list указывает с какой записи начинать выводить данные.
		// Если это число не определено, то будем выводить
		// с самого начала, то-есть с нулевой записи

		$list=0;
		// Вывести $quantity записей на $page станицу, начиная с записи $list
		$list=($page-1)*$quantity;

		$res = mysqli_query($link,"SELECT * FROM people LIMIT $quantity OFFSET $list;")or die(mysqli_error($link));


		// Выводим все записи текущей страницы
		for ( $i = $list ;  ( $i < $list+mysqli_num_rows($res) ) ; $i++ )
		{
			$result = mysqli_fetch_array($res);
			echo
				"<div id=\"message\">
					<div id=\"alll\">
						<div id=\"all\">".$result['name']."</div>
					</div>
					<div id=\"alll\">
						<div id=\"clmn\"><div id=\"clmn2\">оставил(а) запись:</div></div>
						<div id=\"clmnT\">".$result['message']."</div>
					</div>
				</div>"
			;
		}

		echo '<div id="strr">Страницы: ';
		//Ссылки на какие страницы добавим. Т.е. для 4 вывести 2 3 4 5 6
		$start = $page-$limit;$end = $page+$limit;
		if ($start<1) $start=1; 
		if ($end>$pages) $end=$pages;
		// Ссылки внутри страницы
		for ($j = $start; $j<=$end; $j++) {
				// Ссылка на текущую страницу выделяется жирным
				if ($j==($page)) echo '<a href="' . $_SERVER['SCRIPT_NAME'] .
					'?page=' . $j . '"><strong style="color: white;background-color: grey;"> ' . $j . ' </strong></a> &nbsp; ';
				else echo '<a href="'.$_SERVER['SCRIPT_NAME'].'?page='.$j.'">'.$j.'</a> &nbsp;';
		}
		//&nbsp; - неразрывный пробел
		echo '</div><div id="strr">';
		
		//Ссылки "назад" и "на первую страницу"
		if ($page>=2) {
			echo '<a href="'.$_SERVER['SCRIPT_NAME'].'?page=1"> |В начало| </a> &nbsp; ';
			echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?page=' . ($page-1) . '"> |Назад| </a> &nbsp; ';
		}
		//Ссылки "вперед" и "на последнюю страницу"
		if ($page<$pages) {
			echo '<a href=" '.$_SERVER['SCRIPT_NAME'].'?page='.($page+1).'"> |Вперед| </a> &nbsp;';
			echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?page=' . ($pages) .'"> |В конец| </a> &nbsp;';
		}
		echo '</div>';
			/*
            while ($result = mysqli_fetch_array($res))
            {
                echo
                    "<div id=\"message\">

                        <div id=\"alll\">
                            <div id=\"all\">".$result['name']."</div>
                        </div>
                        <!--<div id=\"alll\">
                            <div id=\"clmn\">".$result['name']."</div>
                            <div id=\"clmnT\"></div>
                        </div>-->
                        <div id=\"alll\">
                            <div id=\"clmn\"><div id=\"clmn2\">оставил(а) запись:</div></div>
                            <div id=\"clmnT\">".$result['message']."</div>
                        </div>
                    </div>";
            }
            */
		echo '<div id="sos">В любой непонятной ситуации нажми <a href=" '.$_SERVER['SCRIPT_NAME'].'?page='.$page.'"><strong> ОБНОВИТЬ </strong></a> </div>&nbsp;';
		// закрываем подключение
		mysqli_close($link);
		?>
	<!--</div>-->
	<div id="main">
		<br>
		Чтобы добавить новую запись, нажмите...
	</div>
	<div id="header"><div id="head"><a href="index.php">Новая запись</a></div></div>
</body>
</html>
