<?php
/**
*
* �������� ������� �������� �����
*
*/
/**
*
* ������� ��� ������ � ����� ������
*
*/

/** recource db_connect ( string host, string user, string passwd, string dbname )
* ����������� � ���� � �������� ���� ������
*/
function db_connect($host, $user, $passwd, $dbname)
{
	$link = mysqli_connect($host, $user, $passwd, $dbname) or die('Could not connect to database');
	mysqli_select_db($link, $dbname) or die('Could not select database');
	return $link;
}

/** ��������� ������ � ��
*
* @param ����� �������
* @return resource id
*/
function db_query($link, $query)
{
	$result = mysqli_query($link, $query)
	  or die('Bad database query');
	return $result;
}

/** ��������� ������ � �� (placeholder)
*
* @param ����� �������
* @param*
* @return resource id
*/
function db_query_ex($query)
{
	$values = func_get_args();
	array_shift($values);
	$i = 0;
$link = mysqli_connect("localhost","root", "","test");
	return db_query($link,preg_replace('%\?%e', '"\'".addslashes($values[$i++])."\'"', $query));
}



function gb_install()
{
$link = mysqli_connect("localhost","root", "","test");
	db_query($link,
		'CREATE TABLE IF NOT EXISTS gb (
			id int(10) unsigned NOT NULL auto_increment,
			datetime datetime NOT NULL default \'0000-00-00 00:00:00\',
			name varchar(100) NOT NULL default \'\',
			email varchar(100) default NULL,
			message text NOT NULL,
			PRIMARY KEY (id),
			INDEX (datetime)			
		) ENGINE=MyISAM;'
	);
}

/**
* ���������� ������ � �������� �����
*/
function gb_add($name, $email, $message, &$error)
{
	// ��������� ������������ ���������� �����
	$error = '';
	if(empty($name))
		$error['name'] = '��� ������������ ����';
	if(empty($message))
		$error['message'] = '��� ������������ ����';
	if(!empty($email) && !strings_isemail($email))
		$error['email'] = '��� �� email';

	// ���� �� ���� ������ -- ���������
	if(!$error)
	{
		// ������ ������
		$name = strings_clear($name);
		$message = strings_clear($message);
		$name = strings_stripstring($name, 15, 100);
		$email = strings_stripstring($email, 100, 100);
		$message = strings_stripstring($message, 100, 2000);
		$message = nl2br($message);

		

		// ������ �� ���������� ������ � ���� ������
		db_query_ex('INSERT INTO gb (name, email, message, datetime) VALUES(?, ?, ?, ?, NOW())', $name, $email,  $message);
		// ������������ ������� �� ������ ��������
		// ��� �����, �����, ���� ������������ ������ ������ Refresh, ������ �� ���������� ��� ���
		header('Location: '.PATH."?page=1");
	}
}

// �������� ������ �� �������� �����
function gb_delete($id)
{
  // ������ �� �������� ������ �� ���� ������
  // WHERE id = '.$id ��������� �� ������, ������� ������� �������
  db_query_ex('DELETE FROM gb WHERE id = ?', $id);
  header('Location: '.PATH."?page=1"); // ???
}

// ����� �������� � ��������
function gb_show($page)
{
	// ��������� ������ ������ ��������
	$begin = ($page - 1) * 10;
	// ������� ������� �� ���� ������
	// SELECT * FROM gb -- ��� ���� �� �� gb
	// ORDER BY datetime DESC -- ���������� �� ����, ����� ������
	// LIMIT '.$begin.','.RECSPERPAGE -- �����������: RECSPERPAGE (��. defines.php) ������� ������� � $begin
$link = mysqli_connect("localhost","root", "","test");	
$result = db_query($link,'SELECT * FROM gb ORDER BY datetime DESC LIMIT '.$begin.', '.RECSPERPAGE);
	$out = '';

	// ���� �� ���� ��������� �������
	while($row = mysqli_fetch_array($result))
		$out .= template_show_body($row['id'], $row['name'], $row['email'], $row['message'], $row['datetime']);

	// ���������� ���������
	mysqli_free_result($result);

	echo $out;
}

// ����� ������ �������
function gb_showpages($current)
{ 
$link = mysqli_connect("localhost","root", "","test");
	// ������ ����� ������� � �������� �����
	$result = db_query($link,'SELECT * FROM gb');
	$rows = mysqli_num_rows($result);
	if($rows)
	{
		$pages = ceil($rows / RECSPERPAGE);

		// �������� ������ �� �������� (����� ������� �������� �� �������� �������)
		echo '<div class=c>';
		for($i = 1; $i <= $pages; $i++)
		{
			if($i != $current)
				echo ' | <a href='.PATH.'?page='.$i.'>'.$i.'</a>';
			else
				echo ' | '.$i;
		}
		echo ' |';

		// ���� ��� �� ���������� �������� �������� ������ "������"
		if($current < $pages)
			echo ' <a href='.PATH.'?page='.($current + 1).'>next &gt;&gt;</a>';
		echo '</div>';
	}
}

?>