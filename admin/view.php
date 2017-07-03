<html>
	<head>
		<title>Гостевая книга</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link href="/all.css?" type="text/css" rel="stylesheet">
	</head>
	<body>
		<div class="column-center">
			<h1>ГОСТЕВАЯ КНИГА</h1>
			<div style="text-align: center;"><a href="/" class="text">На главную страницу</a></div>
			<? if (empty($data_messeges)) : ?>
				<div class="null_mess">Нет сообщений, нуждающихся в модерации</div>
			<? else : ?>
				<? foreach($data_messeges as $value): ?>
					<div class="messang">
						<div class="author">
							<span class="bold"><?=$value['name'];?></span><br>
							<? if (!empty($value['city'])) echo $value['city'].'<br>';?>
							<? if (!empty($value['email'])) echo $value['email'].'<br>';?>
							<? if (!empty($value['url'])) echo '<a href="'.$value['url'].'">'.$value['url'].'</a><br>';?>
							<?=$value['puttime'];?><br>
							<a href="/admin/?delete=<?=$value['id_msg'];?>" class="button">Удалить</a><a href="/admin/?show=<?=$value['id_msg'];?>" class="button">Одобрить</a>
						</div>
						<p><?=$value['msg'];?></p>
						<div class="clear"></div> 
					</div>
					<div class="line"></div>
				<? endforeach; ?>
			<? endif; ?>
		</div>
	</body>
</html>