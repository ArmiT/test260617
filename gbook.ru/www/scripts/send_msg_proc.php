<?php

  $name = $_POST['username'];
  $email = $_POST['email'];
  $msg = $_POST['msg'];

  if (!isset($name) || !isset($email) || !isset($msg)) {
    echo "status:null";
    exit();
  }

  if (strlen($name) > 255 || strlen($msg) > 512) {
    echo "status:len";
    exit();
  }

  require_once("../db.php");
  require_once("../models/messages.php");

  $token = db_connect();

  $status = new_msg($token, $name, $email, $msg);
  if ($status) {
    echo "status:ok";
  } else {
    echo "status:fail";
  }
?>
