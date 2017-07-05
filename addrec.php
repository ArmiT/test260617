<?php
session_start();
$sid_add_theme = session_id();
// ������������� ���������� � ����� ������
include "config.php";
$error = "";
$action = "";
// ���������� �������� ���������� action, ���������� � ����
$action = $_POST["action"];
// ���� ��� �� ����� - ��������� ��������� � ���� ������
if (!empty($action)) 
{
  // ��������� ��������� �� ������������� ������ �
  // ���������� � ����� - ������ � ����-��������
  if($sid_add_theme != $_POST['sid_add_theme'])
  {
    $action = ""; 
    $error = $error."<LI>������ ���������� ��������� � �������� �����\n";
  }
  // ��������� ��������� �� ������� ������� �����
  $lenmsg = strlen($msg);
  $templen = 0;
  $temp = strtok($msg, " ");
  if (strlen($msg)>60)
  {
    while ($templen < $lenmsg)
    { 
      if (strlen($temp)>60)
      {
        $action = ""; 
        $error = $error."<LI>����� ��������� �������� ������� ����� �������� ��� ��������\n";
        break;
      }
      else
      {
        $templen = $templen + strlen($temp) + 1;
      }
      $temp = strtok(" ");            
    }       
  }
  
  // ��������� ������������ ����� ���������� � ���� �����
  if (empty($_POST["msg"])) 
  {
    $action = ""; 
    $error = $error."<LI>�� �� ����� ���������\n";
  }
  if (empty($_POST["name"])) 
  {
    $action = ""; 
    $error = $error."<LI>�� �� ����� ���\n";
  }

  // ��� ������ ���������� ��������� ��������� ������������ ����� e-mail
  if(!empty($_POST["email"]))
  {
    if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $_POST["email"]))
    {
      $action = "";
      $error = $error."<LI>������� ������ �-mail.&nbsp ������� e-mail � ���� <i>something@server.com</i> \n";
    }
  }
  
  // ������������ HTML-���� � ������� � ��������� � ����������
  // �� ������, ������������ ����� ���������
  $name = substr($_POST["name"],0,32);
  $name = htmlspecialchars(stripslashes($name));
  $email = substr($_POST["email"],0,32);
  $email = htmlspecialchars(stripslashes($email));
  $msg = substr($_POST["msg"],0,1024);
  $msg = htmlspecialchars(stripslashes($msg));
  
  
      
  

  if (empty($error)) 
  {
    $msg = nl2br($msg);
    // ������������ ���������� ����
    $msg = str_replace("[u]","<u>",$msg);
    $msg = str_replace("[U]","<u>",$msg);
    $msg = str_replace("[i]","<i>",$msg);
    $msg = str_replace("[I]","<i>",$msg);
    $msg = str_replace("[b]","<B>",$msg);
    $msg = str_replace("[B]","<B>",$msg);
    $msg = str_replace("[sub]","<SUB>",$msg);
    $msg = str_replace("[SUB]","<SUB>",$msg);
    $msg = str_replace("[sup]","<SUP>",$msg);
    $msg = str_replace("[SUP]","<SUP>",$msg);
    $msg = str_replace("[/u]","</u>",$msg);
    $msg = str_replace("[/U]","</u>",$msg);
    $msg = str_replace("[/i]","</i>",$msg);
    $msg = str_replace("[/I]","</i>",$msg);
    $msg = str_replace("[/b]","</B>",$msg);
    $msg = str_replace("[/B]","</B>",$msg);
    $msg = str_replace("[/SUB]","</SUB>",$msg);
    $msg = str_replace("[/sub]","</SUB>",$msg);
    $msg = str_replace("[/SUP]","</SUP>",$msg);
    $msg = str_replace("[/sup]","</SUP>",$msg);
    $msg = str_replace("\n"," ",$msg);
    $msg = str_replace("\r"," ",$msg);
    // �������� ��� ��������� ������� ���������
    // ������ �� ������������ ��������
    $name = str_replace("'","`",$name);
    $email = str_replace("'","`",$email);
    $msg = str_replace("'","`",$msg);
    // ������ � ���� ������ �� ���������� ���������
    $query = "INSERT INTO guest VALUES (0,
                                        '$name',
                                        '$city',
                                        '$email',
                                        '$url',
                                        '$msg',
                                        '-',
                                        NOW(),
                                        'show');";
    if(mysql_query($query))
    {
      // ���� � ���������������� ����� $sendmail = true ���������� �����������
      if($sendmail)
      {
        $thm = "guestbook - a new post";
        $msg = "post: $msg\nname: $name";
        mail($valmail, $thm, $msg);
      }
      // ������������ �� ������� �������� ���� �� ������ ������
      print "<HTML><HEAD>\n";
      print "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php'>\n";
      print "</HEAD></HTML>\n";
      exit();
    }
    else
    {
      // ������� ��������� �� ������ � ������ �������
      echo "<a href='index.php'>���������</a>";
      echo("<P> ������ ��� ���������� ���������</P>");
      echo("<P> $query</P>");
      exit();
    }
  }
}

if (empty($action)) 
{
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title></title>
<link rel="StyleSheet" type="text/css" href="guestbook.css">
</head>
<body bottommargin="0" marginheight="0" marginwidth="0" rightmargin="0" leftmargin="0" topmargin="0">
<table border="0" cellspacing="0" width="100%" cellpadding="0">
    <tr>
        <td colspan="3" height="35"><p class="pcolor1"><nobr><b>�������� �����</nobr></b></p></td>
        <td width="100%" colspan="2"><nop></td>
    </tr>
    <tr align="center">
        <td width="150" colspan="2"><nop></td>
        <td height="4" bgcolor="#EAEAEA"><nop></td>
        <td bgcolor="silver"><nop></td>
        <td bgcolor="gray"><nop></td>       
    </tr>
</table>
<table width="100%">    
    <tr align="right">
        <td>
            <a class=link href="index.php" title="��������� � �������� �����">�������� �����</a>&nbsp;&nbsp;
        </td>
        <td width="10%">&nbsp;</td>
    </tr>   
</table>
<form action=addrec.php method=post>
<input type=hidden name=sid_add_theme value='<?php echo $sid_add_theme; ?>'>
<input type=hidden name=action value=post>
<table><tr valign="top"><td width="25%">&nbsp;</td><td>
<table border="0" align="center" cellpadding="6" cellspacing="0">
    <tr valign="top">
        <td colspan="3" height="60">
            <p class="pcolor2"><b>���������� ���������</b>
        </td>
    </tr>
    <tr>
        <td width="50"><p class=ptd><b><em class=em>��� *</em></b></td>
        <td><input type=text name=name maxlength=32 size=25 value='<? echo $name; ?>'></td>
        <td rowspan="3" width="120">
            <p class=help>* ������� ������ �������� ����, ������������ ��� ����������
        </td>
    </tr>
    <tr>
        <td><p class=ptd><b>&nbsp;&nbsp;&nbsp;<nobr>E-mail</nobr></b></td>
        <td><input type=text name=email size=25 maxlength=32 value='<? echo $email; ?>'></td>
    </tr>
    <tr>
        <td colspan="3" height="10"><nop></td>
    </tr>   
    <tr>
        <td colspan="3">
            <p class=ptd><b><em class=em>��������� *<em></b><br>
            <textarea cols=42 rows=5 name=msg><? echo $msg; ?></textarea>
        </td>
    </tr>   
    <tr>
        <td colspan="3">
            <input type="submit" value="��������">&nbsp;&nbsp;&nbsp;
        </td>
    </tr>           
</table>
</td><td>
<table border="0" cellspacing="1" cellpadding="4">
    <tr align="left"><td><p class=ptext><u><i><b><nobr>��������������  ����:</nobr></b></i></u></td></tr>
    <tr><td><p class=ptext><nobr>[b]<b>������</b>[/b]</nobr></td></tr>
    <tr><td><p class=ptext><nobr>[i]<i>���������</i>[/i]</nobr></td></tr>
    <tr><td><p class=ptext><nobr>[u]<u>������������</u>[/u]</nobr></td></tr>
    <tr><td><p class=ptext><nobr>[sup]<sup>������� ������</sup>[/sup]</nobr></td></tr>
    <tr><td><p class=ptext><nobr>[sub]<sub>������ ������</sub>[/sub]</nobr></td></tr>   
</table>
</td></tr></table>
</form>
</body>
</html>
<?php
  // ������� ��������� �� ������
  if (!empty($error)) 
  {
    print "<P><font color=green>�� ����� ���������� ������ ��������� ��������� ������: </font></P>\n";
    print "<UL>\n";
    print $error;
    print "</UL>\n";
  }
}
?>