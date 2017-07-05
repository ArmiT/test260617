<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<title>Гостевая книга</title>
		<link rel="stylesheet" href="style.css">
	</head>


<?php

include_once "config.php";
include "database.php";
    
$query ="SELECT * FROM book";
$result = mysqli_query($link1, $query) or die("Ошибка " . mysqli_error($link1)); 
$action=$_REQUEST['a'];
// Определние общего числа отзывов
$r1 = mysqli_query($link1, "SELECT count(*) as recs FROM book WHERE flag = 0");
$row = mysqli_fetch_array($r1, MYSQLI_BOTH);
$rec = $row[0];  // Общее кол-во записей в таблице
	
// SQL-запрос
$q="SELECT * FROM book WHERE flag=0";
	
$r = mysqli_query($link1, $q);
$n = mysqli_num_rows($r);


	
// Вывод записей
for($i=0; $i<$rec; $i++)
{
	$row = mysqli_fetch_array($r, MYSQLI_BOTH);
	$username = $row['name'];
		
	echo "<p><table width=100%>
	      <tr><td bgcolor=C0C0C0 width=10%>
		  <font name=Tahoma size=2>$username, <br> $row[dt]<br>
		  <a href=admin.php?a=approve&id=$row[id]>Одобрить | </a> <a href=admin.php?a=del&id=$row[id]>Удалить</a>";
		    
			
	echo "</font></td>";
	
	echo "<td colspan=2 >
	      <font name=Tahoma size=2>$row[comment]</td>
		  </tr></table>";	
}

    if ($rec){
	$action = $_GET['a'];
	$ID = $row['id'];
    
	
	// Одобрение объявления
	if ($action == "approve") 
	{
		$q1 ="UPDATE book set flag = 1 where id = $ID";
		mysqli_query($link1, $q1);
		echo "Отзыв $ID был одобрен";
	}
	
	// Удаление объявления
	
	 if ($action == "del")
	 {
	    $q1 = "DELETE FROM book WHERE id = $ID";
		 mysqli_query($link1, $q1);
		 echo "Объявление $ID было удалено";			
	 }
    }else{
        echo "Новых отзывов нет!";
    }
	
	echo "<br><a href=index.php>На главную</a>";
?>
	
</html>