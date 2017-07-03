<html>
	<head>
		<title>Гостевая книга</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link href="/all.css?" type="text/css" rel="stylesheet">
	</head>
	<body>
	<div class="column-center">
		<h1>ГОСТЕВАЯ КНИГА</h1>
		<div class="new_mess">
			<h2>Написать сообщение</h2>
			<form action="index.php" method="post">
				<table>
					<tr>
						<td class="one">Имя</td>
						<td class="two"><input type="text" name="name" class="text" maxlength="32" value="<?=$data_form ['name'];?>"></td>
					</tr>
					<tr>
						<td class="one">Город</td>
						<td class="two"><input type="text" name="city" class="text" maxlength="32" value="<?=$data_form ['city'];?>"></td>
					</tr>
					<tr>
						<td class="one">E-mail</td>
						<td class="two"><input type="text" name="email" class="text" maxlength="32" value="<?=$data_form ['email'];?>"></td>
					</tr>
					<tr>
						<td class="one">URL</td>
						<td class="two"><input type="text" name="url" class="text" maxlength="36" value="<?=$data_form ['url'];?>"></td>
					</tr>
				</table>
				Сообщение<br><textarea class="text" name="msg"><?=$data_form ['msg'];?></textarea><br>
				<input type="submit" class="go" value="Отправить">
			</form>
			<? if (!empty($errors)): ?>
			<ul style="color: red;">
				<? foreach($errors as $value): ?>
				<li><?=$value;?></li>
				<? endforeach; ?>
			</ul>
			<? endif;?>
			<div class="dop_info">
				<b>Поддерживаемые тэги:</b><br><br>
					[b]<b>Жирный</b>[/b]<br><br>
					[i]<i>Наклонный</i>[/i]<br><br>
					[u]<u>Подчеркнутый</u>[/u]<br><br>
					[sup]<sup>Верхний индекс</sup>[/sup]<br><br>
					[sub]<sub>Нижний индекс</sub>[/sub]<br><br><br>
				Сообщение не появится в гостевой книге мгновенно, так как оно в течении суток находится на модерации.
			</div>
		</div>

		<? if (empty($data_messeges)) : ?>
			<div class="null_mess">В гостевую книгу не добавлено сообщений.</div>
		<? else : ?>
			<? foreach($data_messeges as $value): ?>
				<div class="messang">
					<div class="author">
						<span class="bold"><?=$value['name'];?></span><br>
						<? if (!empty($value['city'])) echo $value['city'].'<br>';?>
						<? if (!empty($value['email'])) echo $value['email'].'<br>';?>
						<? if (!empty($value['url'])) echo '<a href="'.$value['url'].'">'.$value['url'].'</a><br>';?>
						<?=$value['puttime'];?>
					</div>
					<p><?=$value['msg'];?></p>
					<div class="clear"></div> 
				</div>
				<div class="line"></div>
			<? endforeach; ?>
		<? endif; ?>

		<? if (!empty($data_pages)) : ?>
			<div class="pages">
				<?$class_page = array (1 => 'class1', 2 => 'class2', 3 => 'class3');?>
				<?foreach($data_pages as $value):?>
					<? if ($value[1] == 1): ?><a href="/?page=<?=$value[0];?>"><? endif;?>
					<div class="all <?=$class_page[$value[1]];?>"><?=$value[0];?></div>
					<? if ($value[1] == 1): ?></a><? endif;?>
				<? endforeach; ?>
			</div>
		<? endif; ?>
	</div>
</body>
</html>