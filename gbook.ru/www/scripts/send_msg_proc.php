<?php

  $name = trim($_POST['username']);
  $email = trim($_POST['email']);
  $msg = trim($_POST['msg']);

  if (empty($name) || empty($email) || empty($msg)) {
    echo "status:null";
    exit();
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "status:email";
    exit();
  }

  if (mb_strlen($name) > 255 || mb_strlen($msg) > 512) {
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
