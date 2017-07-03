<?php
error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
	include ("dbconnect.php");
?>

<html>
<body>

<h1>Гостевая книга</h1>
	
<!-- блок отображения сообщений-->
	
<?php
	$c=0;
	$r=mysql_query ("SELECT * FROM gb ORDER BY dt DESC"); // выбор всех записей из БД, отсортированных так, что самая последняя отправленная запись будет всегда первой.
	while ($row=mysql_fetch_array($r))  // для каждой записи организуем вывод.
	{
		if ($c%2)
			$col="bgcolor='#f9f9f9'";	// цвет для четных записей
		else
			$col="bgcolor='#f0f0f0'";	// цвет для нечетных записей
			
			?>
			<table border="0" cellspacing="3" cellpadding="0" width="90%" <? echo $col; ?> style="margin: 10px 0px;">
			<tr>
				<td width="150" style="color: #999999;">Имя пользователя:</td>
				<td><?php echo $row['username']; ?></td>
			</tr>
			
			<tr>
				<td width="150" style="color: #999999;">Дата опубликования:</td>
				<td><?php echo $row['dt']; ?></td>
			</tr>	
			<tr>
				<td colspan="2" style="color: #999999;">---------------------------------------------------------------</td>
			</tr>		
			<tr>
				<td colspan="2">
					<?php echo $row['msg']; ?>
					<br>
				</td>
			</tr>
			
			</table>
			<?php
		$c++;
	}
	
	if ($c==0) // если ни одной записи не встретилось
		echo "Гостевая книга пуста!<br>";
	

?>


<br>
<h3>Добавить сообщение</h3>
<!-- форма отправки сообщения -->

<!-- проверка заполнения формы -->
<script>
function splash()
{
	if (document.myForm.username.value  =='')
		{
			alert ("Заполните имя пользователя!");
			return false;	
		}
		
	if (document.myForm.msg.value  =='')
		{
			alert ("Заполните текст сообщения!");
			return false;	
		}
	
	return true;   
}
</script>

<!-- код формы -->
<form name="myForm" action="action.php" method="post" onSubmit="return splash();">
<input type="hidden" name="action" value="add">
<table border="0">
	<tr>
		<td width="160">
			Имя пользователя:
		</td>
		<td>
			<input name="username" style="width: 300px;">
		</td>
	</tr>
	<tr>

	<tr>
		<td width="160">
		E-mail:
		</td>
		<td>
			<input name="email" style="width: 300px;">
		</td>
	</tr>
		<td width="160" valign="top">
			Сообщение:
		</td>
		<td>
			<textarea name="msg" style="width: 300px;"></textarea>
		</td>
	</tr>		
	<tr>
		<td width="160">
			&nbsp;
		</td>
		<td>
			<input type="submit" value="Отправить сообщение">
		</td>
	</tr>
</table>
</form>

</body>
</html>