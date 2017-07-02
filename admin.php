<html>
<head>
    <title>Гостевая книга</title>
<link rel="stylesheet" type="text/css" href="css/stylesCh.css">
	<link rel="stylesheet" type="text/css" href="css/stylesHead.css">
</head>
<body>
<div id="header">
    <div id="block1"><br></div>
    <div id="block2"> _Страничка АДМИНИСТРАТОРА_</div>
    <div id="block1">
		<div id="button">
			<a href="chat.php?page=1&sort=0" title="Назад"><img src="img/back.png" alt="Назад"></a>
			<?php
			require_once 'link.php'; //$_GET['page'] & $_GET['sort']
			if ($sort==1)
			{//ASС
				echo 'Сейчас: cначала новые<a href="sort.php?page=' . $page . '&sort=' . $sort . '&back=0" title="cначала старые"><img src="img/up_arrow.png" alt="Сначала новые"></a>';}
			else
			{//DESC
				echo 'Сейчас: cначала старые<a href="sort.php?page='.$page.'&sort='.$sort.'&back=0" title="cначала новые"><img src="img/down_arrow.png" alt="Сначала старые"></a>';}
			?>
    	</div>
	</div>
</div>
		
	<?php
		require_once 'connection.php'; // подключаем скрипт

		// подключаемся к серверу
		$link = mysqli_connect($host, $user, $password, $database)
		or die("Ошибка " . mysqli_error($link));

		// Ограничиваем количество ссылок, которые будут выводиться перед и после текущей страницы
		$limit=2;

		if (isset($_GET['page'])) $page =   $_GET['page'];
		//В любой непонятной ситуации выводи первую страницу
		if ($page<1) $page=1; if(!is_numeric($page)) $page=1;

		if (isset($_GET['sort'])) $sort =   $_GET['sort'];
		//В любой непонятной ситуации сортируй снизу вверх
		if ($sort!=0&$sort!=1) $sort=0; if(!is_numeric($sort)) $sort=0;

		// !!!!!!!!!!!!!!!!!выполняем операции с базой данных
		$sql = " SELECT * FROM people WHERE admission!=1";
		$res = mysqli_query($link,$sql) or die(mysqli_error($link));

		$quantity=5;
		$num = mysqli_num_rows($res);
		// Округляем до целого (Кол-во записей в БД/ Кол-во записей на странице)
		$pages = ceil($num/$quantity);
		if ($pages<$num/$quantity) $pages++;
		//Ограничение сверху
		if ($page>$pages) $page = 1;

		// Текущая станица на черном фоне
		echo '<div id="header"><div id="head"><strong>- '.$page.' -</strong><br><div style="color: #83E5F8;">(  '.$page.' из '.$pages.' )</div></div></div>';
		
		$list=0;
		// Вывести $quantity записей на $page станицу, начиная с записи $list
		$list=($page-1)*$quantity;

		If ($sort==1) $res = mysqli_query($link,"SELECT * FROM people WHERE admission!=1 ORDER BY `id` DESC LIMIT  $quantity OFFSET $list;")or die(mysqli_error($link));
		If ($sort!=1) $res = mysqli_query($link,"SELECT * FROM people WHERE admission!=1 ORDER BY `id` ASC LIMIT  $quantity OFFSET $list;")or die(mysqli_error($link));

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
						<div id=\"clmnT\">
							<div id=\"dop\">".$result['message']."<br>
								<div id=\"clmnT2\">".$result['date']."<br></div>
							</div>
							<div id=\"dop2\">
								<div id=\"button\"><a href='delete.php?id=".$result['id']."&page=".$page."&sort=".$sort."' title='Удалить'><img src=\"img/No.png\" alt=\"Назад\"></a>	
								<a href='admission.php?id=".$result['id']."&page=".$page."&sort=".$sort."' title='Одобрить'><img src=\"img/Yes.png\" alt=\"Назад\"></a></div>	
							</div>
						</div>
					</div>
				</div>"
			;
		}

		if ($pages>1)
		{
			echo '<div id="strr">Страницы: ';
			//Ссылки на какие страницы добавим. Т.е. для 4 вывести 2 3 4 5 6
			$start = $page-$limit;$end = $page+$limit;
			if ($start<1) $start=1; 
			if ($end>$pages) $end=$pages;
			// Ссылки внутри страницы
			for ($j = $start; $j<=$end; $j++) {
					// Ссылка на текущую страницу выделяется жирным
					if ($j==($page)) echo '<a href="' . $_SERVER['SCRIPT_NAME'] .
						'?page=' . $j . '&sort='.$sort.'"><strong style="color: white;background-color: grey;"> ' . $j . ' </strong></a> &nbsp; ';
					else echo '<a href="'.$_SERVER['SCRIPT_NAME'].'?page='.$j.'&sort='.$sort.'">'.$j.'</a> &nbsp;';
			}
			//&nbsp; - неразрывный пробел
			echo '</div><div id="strr">';
			
			//Ссылки "назад" и "на первую страницу"
			if ($page>=2) {
				echo '<a href="'.$_SERVER['SCRIPT_NAME'].'?page=1&sort='.$sort.'"> |В начало| </a> &nbsp; ';
				echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?page=' . ($page-1) . '&sort='.$sort.'"> |Назад| </a> &nbsp; ';
			}
			//Ссылки "вперед" и "на последнюю страницу"
			if ($page<$pages) {
				echo '<a href=" '.$_SERVER['SCRIPT_NAME'].'?page='.($page+1).'&sort='.$sort.'"> |Вперед| </a> &nbsp;';
				echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?page=' . ($pages) .'&sort='.$sort.'"> |В конец| </a> &nbsp;';
			}
			echo '</div>';				
		}

		echo '<div id="sos">В любой непонятной ситуации нажми <a href=" '.$_SERVER['SCRIPT_NAME'].'?page='.$page.'&sort='.$sort.'"><strong> ОБНОВИТЬ </strong></a> </div>&nbsp;';
		// закрываем подключение
		mysqli_close($link);
	?>

</body>
</html>