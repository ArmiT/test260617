<html>
<head>
<title>Гостевая книга</title>
	<link rel="stylesheet" type="text/css" href="css/stylesAdAt.css">
	<link rel="stylesheet" type="text/css" href="css/stylesHead.css">
</head>
<body>
	<div id="header">
		<div id="block1"><br></div>
		<div id="block2">ГОСТЕВАЯ КНИГА:<div id="head"> _АУТЕНТИФИКАЦИЯ АДМИНИСТРАТОРА_</div></div>
		<div id="block1"><div id="button">
			<?php
			if (isset($_GET['back'])) $back =   $_GET['back'];
			if ($back=="" ) $back="index"; 
			if ($back=="index" | $back=="chat" ) echo '<a href="'.$back.'.php" title="Назад"><img src="img/b.png" alt="Назад"></a>';
			?>
		</div></div>		
	</div>
			
</body>
</html>
