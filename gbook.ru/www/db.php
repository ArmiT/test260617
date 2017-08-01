<?php
  define('MYSQL_SERVER', 'localhost');
  define('MYSQL_USER', 'root');
  define('MYSQL_PASSWORD', '');
  define('MYSQL_DB', 'gbook_msg_db');
  define('MYSQL_TABLE', 'messages');

  function db_connect() {
    $token = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB)
    or die("Error DB: " . mysqli_error($token));

    if (!mysqli_set_charset($token, "utf8")) {
      printf("Error DB: " . mysqli_error($token));
    }

    return $token;
  }
?>
