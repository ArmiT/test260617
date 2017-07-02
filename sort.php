<?php
    require_once 'link.php'; //$_GET['page'] & $_GET['sort']
    if (isset($_GET['back']))
    {
        $back =   $_GET['back'];
        //Куду вернуться

		// Если Desc
        if ($sort==1) 
        {//ASC
            $sort=0;}
        else
        {//DESC
            $sort=1;}
        if ($back==0) echo "<meta http-equiv='refresh' content='0; url=admin.php?page=".$page."&sort=".$sort."'>";
        else 
		{
		echo "<meta http-equiv='refresh' content='0; url=chat.php?page=".$page."&sort=".$sort."'>";
		}
    }
	else echo "<meta http-equiv='refresh' content='0; url=chat.php?page=".$page."&sort=".$sort."&back=7'>";
?>
