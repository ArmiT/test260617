<?php
  require_once("../db.php");
  require_once("../models/messages.php");

  $token = db_connect();

  $msg_id = $_POST['msgID'];
  $status = false;

  if (isset($_POST['msgDel'])) {
    $status = remove_msg($token, $msg_id);
  } else if (isset($_POST['msgPush'])) {
    $status = publish_msg($token, $msg_id);
  }

  if ($status) {
    header('Location: index.php');
  } else {
    header('Location: err_action.html');
  }
?>
