<?php
  // ��� ����� ��� ���������� ������ �������������� �� ���������.
  if($title == "") $title = "����� �������������� �� ���������";
  $titlepage='���������� �����������';  
  $helppage='��� ���������� ����������� ��������� ����: "��������" � "����������". ������� ������ "��������"';
  // �������� ���������� � ����� ������
  include "../config.php";
  // ��������� �������� $id_msg �� ������ �������
  $id_msg = $_GET['id_msg'];
  $start = $_GET['start'];
  // ������ � ���� ������ ��� ���������� ��������� �
  // ��������� ������ $id_msg
  $query = "SELECT * FROM guest 
            WHERE id_msg = $id_msg";
  $gst = mysql_query($query);
  if ($gst)
  {
    // ����������� ���������� ���������� � ������������� ������
    $guest = mysql_fetch_array($gst);
  }
  // � ������ ������� ������� ��������� �� ������
  else puterror("������ ��� ��������� � �������� �����");
  include "topadmin.php";
?>
<table><tr><td>
<p class=boxmenu><a class=menu href="index.php">��������� � ����������������� �������� �����</a></p>
</td></tr></table>
<center><br>
<table><tr><td>
<form action=editcomment.php method=post>
<textarea class=input cols=42 rows=5 name=msg><? echo $guest['msg']; ?></textarea><br>
<textarea class=input cols=42 rows=5 name=answer><? echo $guest['answer']; ?></textarea><br>
<input class=button type=submit value="���������">
<input type=hidden name=id_msg value=<?php echo $id_msg; ?>>
<input type=hidden name=start value=<?php echo $start; ?>>
</form>
</td></tr></table>
</center>
<?  include "bottomadmin.php"; ?>