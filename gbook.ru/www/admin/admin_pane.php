<?php
  require_once("../db.php");
  require_once("../models/messages.php");

  $token = db_connect();

  $new_msgs = get_all_new_msgs($token);
  foreach ($new_msgs as $msg) {
    include("../views/admin_msg.php");
 }
?>
