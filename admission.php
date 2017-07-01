<html>
<head>
<title>Гостевая книга</title>
	<link rel="stylesheet" type="text/css" href="css/stylesCh.css">
	<link rel="stylesheet" type="text/css" href="css/stylesHead.css">
</head>
<body>
	<div id="header">
			<div id="block1"><br></div>
			<div id="block2">ГОСТЕВАЯ КНИГА: _Одобрение записи_</div>
			<div id="block1"><div id="button"><a href="adminAt.php?back=chat" title="Администратор"><img src="img/c.png" alt="Админ"></a></div></div>
	</div>
		<?php
		if (isset($_GET['id'])) $id =   $_GET['id'];
		echo $id;
		if (isset($_GET['page'])) $page =   $_GET['page'];
		echo $page;
		?>
</body>
</html>
