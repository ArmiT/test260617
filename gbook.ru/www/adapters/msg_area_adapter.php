<?php
  include_once("models/pages.php");

  $count_pages = get_pages_count($token);
  if (isset($_GET['p'])) {
    $this_page = $_GET['p'];
  } else {
    $this_page = 1;
  }

  if ($this_page > $count_pages) {
    include_once('error404.html');
  } else {
    $messages = get_msgs_for_page($token, $this_page);
    include_once("views/messages_area.php");
   }
?>
