<?php
/**
*
* Шаблон страниц
*
*/

/**
* заголовок страницы
*/
function template_header($page)
{
?><html>
<head>
<title>page <?=$page?> &lt; Guestbook </title>
<style>
body{
padding: 15px;
margin: 0;
color: #333;
background-color: #eee;
border-left: 30px solid #adba8e;
font: 500 .9em verdana, arial, helvetica;
}
a:link{color: #250;}
a:visited{color: #639;}
a:active,a:hover{
color: #c00;
text-decoration: underline;
}
h1 { font-size: 150%; }
h2 { font-size: 110%; }

.c{margin-bottom: 10px;}
.cn{
background-color: #d2d6bc;
padding: 2px 4px;
margin-bottom: 4px;
}
</style>
</head>
<body>
<h1>Guestbook</h1><?php
}

/**
* окончание страницы
*/
function template_footer()
{
?><p>Guestbook </a></p></body></html><?php
}

/**
* форма добавления новой записи
*/
function template_form($name, $email, $message, $error)
{
  // вывод сообщения об ошибке
  function error($error)
  {
    if($error) echo '<br><font color=#880000>'.$error.'</font>';
  }

  echo '<h2>Add new message</h2>
<p><table cellspacing="2" cellpadding="2" border="0">
<form action='.PATH. '?add=1 method=post><tr>
<td>Name<font color=#880000>*</font>:</td>
<td><input type=text name="name" size=30
 maxlength=100 value="'.$name.'">';
  @error($error['name']);
  echo '</td>
</tr><tr>
<td>Email:</td>
<td><input type=text name="email" size=30 maxlength=100 value="'.$email.'">';
  @error($error['email']);
  echo '</td>
</tr><tr>
<td>Message<font color=#880000>*</font>:</td>
<td><textarea cols=40 rows=5 name="message">'.$message.'</textarea>';
  @error($error['message']);
  echo '</td>
</tr><tr>
<td>&nbsp;</td>
<td><small><font color=#880000>*</font>&nbsp;&#151; Required fields</small></td>
</tr><tr>
<td>&nbsp;</td>
<td><input name="sb" type=submit value="Add message"></td>
</form></tr>
</table>';
}

/**
* печать одной записи гостевой книги
*/
function template_show_body($id, $name, $email, $www, $message, $datetime)
{
  $out = '<div class=c><div class=cn><b>'.$name.'</b> ';
  // если есть email или homepage -- печатаем их
  if($email)
  {
    $out .= '( ';
    if($email)
      $out .= ' <a href=mailto:'.$email.'>email</a>';
  $out .= ')';
 }
  $out .= ' пишет '.$datetime.':</div>'.$message.'</div>';
  // если гостевую книгу просматривает администратор -- печатаем кнопку удаления записи
  if(auth_is_admin())
  {
    $out .= '<div class=c>[ <a href='.PATH.'?admin=1&del='.$id.'>exterminate!</a> ]</div>';
  }

  return $out;
}

?>