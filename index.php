<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf8">
      <title>Гостевая книга</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="styles.css">
      <link href="https://fonts.googleapis.com/css?family=Kurale" rel="stylesheet">
  </head>
  <body>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
<?php

include_once "config.php";
include "database.php";
        

// Определние общего числа отзывов
$r1 = mysqli_query($link1, "SELECT count(*) as recs FROM book WHERE flag = 1");
$row = mysqli_fetch_array($r1, MYSQLI_BOTH);
$rec = $row[0];  // Общее кол-во записей в таблице
	
	
// Кол-во записей на странице
$N = 10; 

echo "<div class=\"page-header\">
        <h1 align = center> Гостевая книга</h1>
      </div>";

/* Если перменная p (номер страницы) не указана,
то выводится первая страница. */
if (!isset($_GET['p'])) $p=0;
else $p = $_GET['p'];

//Записи для вывода
$records = $p * $N;
		
// SQL-запрос
$q="SELECT * FROM book WHERE flag=1 ORDER BY id DESC LIMIT ".$records.", $N";	
$r = mysqli_query($link1, $q);
$n = mysqli_num_rows($r);

// Форма ввода сообщения
echo '<h3 align = center>Оставьте свой отзыв</h3>';
	
	 
echo '<p>
   <form class="col-md-6 col-md-offset-3 form-horizontal ramka" role="form" name=Main action=add.php method=post>
     <div class="form-group">
	   <label class="col-sm-2 control-label">Ваше имя:</label> 
       <div class="col-sm-10">
         <input type="text" class="form-control" maxlength="255" placeholder="Введите имя" name=uname>
       </div>
     </div>
     <div class="form-group">
	   <label class="col-sm-2 control-label">E-mail:</label> 
       <div class="col-sm-10">
         <input type="email" class="form-control" placeholder="Ваш e-mail" name=uemail>
       </div>
     </div>
     <div class="form-group">
         <label class="col-sm-2 control-label">Отзыв:</label> 
         <div class="col-sm-10">
	       <textarea class="form-control" rows="4" maxlength="512" placeholder="Напишите ваш отзыв здесь!" name=ucomment></textarea>
       </div>
     </div>
     <div class="form-group">
       <div class="col-sm-offset-2 col-sm-10">
	     <button type="submit" class="btn btn-primary btn-lg">Отправить</button>
       </div>
       </br>
   </form>
   </p>
   </br>';
      
// Вывод записей
for($i=0; $i<$n; $i++)
{
	$row = mysqli_fetch_array($r, MYSQLI_BOTH);
	$username = $row['name'];
    $uemail = $row['email'];
		
	echo "<p><table class=\"table table-striped\" width=100%>
	      <tr><td bgcolor=#D3D3D3 width=20%>
		  <font name=Tahoma size=2> $username <br> $uemail <br> $row[dt]</font></td>";
	
	echo "<td colspan=2 >
	      <font name=Tahoma size=2> $row[comment] </td>
		  </tr></table></p>";	
}
		
    
// Навигация по записям
if ($p > 0)
{
	$pn = $p -1;
	  echo "<ul class=\"pager\"><li><a href=index.php?p=$pn>&larr; Назад</a></li></ul>";
}
    
$p++;
	
if ($records + $N < $rec) 
	echo "<ul class=\"pager\"><li><a class=\"pager\" href=index.php?p=$p>Далее &rarr;</a></li></ul>";
	
echo "
<p align=center>
    <a align=center href=admin.php?a=temp>Панель администрирования</a>
</p>";    

    
?>	
  </body>
</html>