<?php
echo('<html>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery-3.2.1.min"></script>
        <script src="js/bootstrap.min.js"></script>');

// начало страницы
	function gb_header(){
		echo('<html>
        <head>
        <title>Гостевая книга</title>
        </head>
        <body style="background-color:#FFF8DC; width: 700px; height: 900px; margin: auto;" repeat-y="">
        <style>
   h1 {
    border: 3px solid #4169E1;
    border-radius: 10px;
    padding: 10px;
    width: 290px;
    background: #ffffff;   
   }
  </style>
  <center>
        <h1>Гостевая книга
        </h1> </center>');
	}


	// форма ввода сообщения
	function gb_form($name, $email, $message){
		echo ('<center><form class="form-horizontal" action="' . PATH . '?add=1" method=post>	
  <table>
		<tbody>
		<tr>
			<td align="left"> * Имя: </td>
			<td align="left"><input name="name" maxlength="255" size="30" type="text"></td>
		</tr>
		<tr>
			<td align="left"> * E-Mail: </td>
			<td align="left"> <input name="email" maxlength="129" size="30" type="text"></td>
		</tr>
		<tr>
			<td align="left"> * Сообщение: </td>
			<td align="left"> <textarea cols="45" rows="5" maxlength="512" name="message"></textarea> </td>
		</tr>
		<tr>
			<td colspan="2" align="right"> <input name="msg_submit" class="btn btn-primary" value=" Добавить  " type="submit">
			<input class="btn btn-primary" value="    Сброс     " type="reset"> </td>
		</tr>
		<tr>
			<td colspan="2" align="center"> * Поля обязательные для заполнения </td>
		</tr>
		</tbody>
		</table>
		</form></center>');
	
	}

    // Вывод одной записи
	function gb_showone($id, $name, $email, $message, $datetime, $approved) 
    {
       
		echo('<div class=c><div class=cn><b>'.$name.'</b>');
		// если есть email -- печатаем
		if($email) {
			echo('(<a href=mailto:' . $email . '>' . $email .'</a>)');
		}
		echo(' | ' . $datetime . ':</div>' . $message . '</div>');
		// если гостевую книгу просматривает администратор -- печатаем кнопку удаления записи
		if(auth_is_admin()) {
			echo('<div class=c>[ <a href=' . PATH . '?admin=1&del=' . $id . '>Удалить</a> ]</div>');
		}
		
		if(!$approved) {
			echo('<div class=c>[ <a href=' . PATH . '?admin=1&approve=' . $id . '>Одобрить</a> ]</div>');
		}
		echo('<p></p>');
     
	}
 ?>