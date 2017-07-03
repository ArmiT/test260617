<?php
if (isset($_GET['page'])) $page =   $_GET['page'];
//В любой непонятной ситуации выводи первую страницу
if ($page<1) $page=1; if(!is_numeric($page)) $page=1;

if (isset($_GET['sort'])) $sort =   $_GET['sort'];
//В любой непонятной ситуации сортируй снизу вверх
if (!($sort==0 | $sort==1)) $sort=0; if(!is_numeric($sort)) $sort=0;
?>