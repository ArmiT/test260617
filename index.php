<?php

  // �������� ���������� � ����� ������
  include "../config.php";
  $title=$titlepage="�������� ����� $version";
  $helppage='����������������� ';
  // ������� ����� ��������
  include "topadmin.php";
  // ������������� �������� �����, ����� �������, ��� ��� �������� �� 
  // ������� ��������, �� ���������� ��� �� ��������� ���������
  // ��������� �����
  $start = $_GET["start"];
  if (empty($start)) $start = 0;
  if ($start < 0) $start = 0;
  // ����������� ����� ����� ���������
  $tot = mysql_query("SELECT count(*) FROM guest;");
  // ����������� ���� ���������
  $gst = mysql_query("SELECT * FROM guest ORDER BY puttime DESC LIMIT $start, $pnumber;");
  if (!$gst || !$tot) puterror("������ ��� ��������� � �������� �����");
  // ��� ������ ����� �������� �� ���� ������
  // ���������
  while($guest = mysql_fetch_array($gst))
  {
    // ���� ����� ��������� �������� ��� ��������� (hide=0), �������
    // ������ "����������", ���� ��� ������� (hide=1) - "������"
    $tableheader = "class=tableheader";
    if($guest['hide'] == 'show') $showhide = "<a class='menu' href=hide.php?id_msg=".$guest['id_msg']."&start=$start title='������ ��������� �� ������ ��������� �� �����'>������ ���������</a>";
    else {
       $showhide = "<a class='menu' href=show.php?id_msg=".$guest['id_msg']."&start=$start title='�������� ����������� ��������� �� �����'>���������� ���������</a>";
       $tableheader = "class=tableheaderhide";
    }
    // ������� ������� � ����������
    ?>
      <p>
      <table class=bodytable width="100%" border="1" cellpadding=5 cellspacing=0 bordercolorlight=gray bordercolordark=white>
          <tr <? echo $tableheader ?> >
              <td><p class=help>����� ���������</td>
              <td width="100"><p class=help>���� ��������</td>
              <td><p class=help>E-mail</td>

          </tr>   
    <?
    echo "<tr><td><p class=zag2>".$guest['name']."</td>";
    echo "<td><p class=help>".$guest['puttime']."</td>";
    echo "<td><p class=help>&nbsp;".$guest['email']."</td>";
    echo "<tr valign=top><td><p class=zag2>���������:</td><td colspan=5><p>".$guest['msg']."</td></tr>";
    echo "<tr><td><p class=zag2>�������������:</td><td colspan=5><p>".$guest['answer']."</td></tr>";
    echo "</table>";
    // ������ �� �������������� � �����
    echo "<p class='menu'><a class='menu' href=editcommentform.php?id_msg=".$guest['id_msg']."&start=$start title='������������� ���������'>�������������</a>";
    // ������ �� ������ ���������   
    echo "&nbsp;&nbsp;".$showhide;
    // ������ �� �������� ���������
    echo "&nbsp;&nbsp;<a class='menu' href=delpost.php?id_msg=".$guest['id_msg']."&start=$start title='������� ���������'>������� ���������</a>";
    echo "</p>";
  }
  // ������� ������ �� ���������� � ��������� ���������
  $total = mysql_fetch_array($tot);
  $count = $total['count(*)'];
  if ($start > 0)  print " <p><A href=index.php?start=".($start - $pnumber).">���������� ���������</A> ";
  if ($count > $start + $pnumber)  print " <p><A href=index.php?start=".($start + $pnumber).">��������� ���������</A> \n";
?>
<br><br>
<?
  echo "<p>�������� ������.</p>";
  include "bottomadmin.php";
?>