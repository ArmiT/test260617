<?php
  // �������� ���������� � ����� ������
  include "../config.php";
  // ��������� ����� ���������� �� ��������� � ��������� ������ $id_msg
  $query = "UPDATE guest SET answer = '".$_POST["answer"]."',
                             msg = '".$_POST["msg"]."' 
           WHERE id_msg=".$_POST["id_msg"];
  if(mysql_query($query))
  {
      // ����� �������� ���������� ��������� �
      // ����������� ����������������� �������� �����
      print "<HTML><HEAD>\n";
      print "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?start=".$_POST["start"]."'>\n";
      print "</HEAD></HTML>\n";
  }
  // � ������ ������� ������� ��������� �� ������
  else puterror("������ ��� ��������� � �������� �����");
?>