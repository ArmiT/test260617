<?php
  // �������� ���������� � ����� ������
  include "../config.php";
  // ��������� SQL-������
  $query = "UPDATE guest SET hide = 'show' 
            WHERE id_msg = ".$_GET["id_msg"];
  // ���������� ��������� � ��������� ������ $id_msg
  if(mysql_query($query))
  {
      // ����� �������� �������� ��������� ��������� �
      // ����������� ����������������� �������� �����
      print "<HTML><HEAD>\n";
      print "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?start=".$HTTP_GET_VARS["start"]."'>\n";
      print "</HEAD></HTML>\n";
  }
  // � ������ ������� ������� ��������� �� ������
  else puterror("������ ��� ��������� � �������� �����");
?>