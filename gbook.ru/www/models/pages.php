<?php

  function get_pages_count($token) {
    $query = "SELECT count(*) FROM messages WHERE state=1";
    $result = mysqli_query($token, $query);

    if (!$result) {
      die(mysqli_error($token));
    }

    $count = mysqli_fetch_row($result);

    return ((int) ($count[0] / 10)) + 1;
  }
?>
