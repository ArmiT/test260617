<?php

  // Получаем соединение с базой данных
  include "../config.php";
  $title=$titlepage="Гостевая книга $version";
  $helppage='Администрирование ';
  // Выводим шапку страницы
  include "topadmin.php";
  // Воспроизводим гостевую книгу, таким образом, как она выглядит на 
  // главной странице, но отображаем так же невидимые сообщения
  // Стартовая точка
  $start = $_GET["start"];
  if (empty($start)) $start = 0;
  if ($start < 0) $start = 0;
  // Запрашиваем общее число сообщений
  $tot = mysql_query("SELECT count(*) FROM guest;");
  // Запрашиваем сами сообщения
  $gst = mysql_query("SELECT * FROM guest ORDER BY puttime DESC LIMIT $start, $pnumber;");
  if (!$gst || !$tot) puterror("Ошибка при обращении к гостевой книге");
  // При помощи цикла выбираем из базы данных
  // сообщения
  while($guest = mysql_fetch_array($gst))
  {
    // Если пункт сообщение отмечено как невидимый (hide=0), выводим
    // ссылку "отобразить", если как видимый (hide=1) - "скрыть"
    $tableheader = "class=tableheader";
    if($guest['hide'] == 'show') $showhide = "<a class='menu' href=hide.php?id_msg=".$guest['id_msg']."&start=$start title='Скрыть сообщение из списка выводимых на сайте'>Скрыть сообщение</a>";
    else {
       $showhide = "<a class='menu' href=show.php?id_msg=".$guest['id_msg']."&start=$start title='Включить отображение сообщения на сайте'>Отобразить сообщение</a>";
       $tableheader = "class=tableheaderhide";
    }
    // Выводим таблицу с сообщением
    ?>
      <p>
      <table class=bodytable width="100%" border="1" cellpadding=5 cellspacing=0 bordercolorlight=gray bordercolordark=white>
          <tr <? echo $tableheader ?> >
              <td><p class=help>Автор сообщения</td>
              <td width="100"><p class=help>Дата отправки</td>
              <td><p class=help>E-mail</td>

          </tr>   
    <?
    echo "<tr><td><p class=zag2>".$guest['name']."</td>";
    echo "<td><p class=help>".$guest['puttime']."</td>";
    echo "<td><p class=help>&nbsp;".$guest['email']."</td>";
    echo "<tr valign=top><td><p class=zag2>Сообщение:</td><td colspan=5><p>".$guest['msg']."</td></tr>";
    echo "<tr><td><p class=zag2>Администратор:</td><td colspan=5><p>".$guest['answer']."</td></tr>";
    echo "</table>";
    // Ссылка на редактирование и ответ
    echo "<p class='menu'><a class='menu' href=editcommentform.php?id_msg=".$guest['id_msg']."&start=$start title='Редактировать сообщение'>Редактировать</a>";
    // Ссылка на правку сообщений   
    echo "&nbsp;&nbsp;".$showhide;
    // Ссылка на удаление сообщений
    echo "&nbsp;&nbsp;<a class='menu' href=delpost.php?id_msg=".$guest['id_msg']."&start=$start title='Удалить сообщение'>Удалить сообщение</a>";
    echo "</p>";
  }
  // Выводим ссылки на предыдущие и следующие сообщения
  $total = mysql_fetch_array($tot);
  $count = $total['count(*)'];
  if ($start > 0)  print " <p><A href=index.php?start=".($start - $pnumber).">Предыдущие сообщения</A> ";
  if ($count > $start + $pnumber)  print " <p><A href=index.php?start=".($start + $pnumber).">Следующие сообщения</A> \n";
?>
<br><br>
<?
  echo "<p>Вероника Шишова.</p>";
  include "bottomadmin.php";
?>