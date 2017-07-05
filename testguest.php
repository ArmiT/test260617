<?php

// ���������� ������
require_once 'my/defines.php';
require_once 'my/template.php';
require_once 'engine/gb.php';
require_once 'engine/lib/auth.php';
require_once 'engine/lib/strings.php';


// ������������ � ��
db_connect(DBHOST, DBUSER, DBPASSWD, DBNAME);

// ������ �������, ���� � ���
gb_install();

// �������� ������ �����, ���� ����� ���� ����������
if (!empty($_POST['sb']))
{
	$name = @$_POST['name'];
	$email = @$_POST['email'];
	$message = @$_POST['message'];
	$formerr = '';
}
else
{
	$name = $email = $message = $formerr = '';
}

// ���� � GET-������� �� ������ ����� ��������, ������� ������
if(is_numeric(@$_GET['page']))
  $page = $_GET['page'];
else
  $page = 1;

// ���� ����� �������� ������, ���������
if(@$_GET['add'])
  gb_add($name, $email, $message, $formerr);

// ���� ����� ������� ������, �������
if(isset($_GET['del']) && auth_is_admin())
  gb_delete(intval($_GET['del']));

// �������� �������� �����
template_header($page);
gb_showpages($page);
gb_show($page);
gb_showpages($page);
template_form($name, $email, $message, $formerr);
template_footer();


?>