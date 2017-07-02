<?php

  function get_all_new_msgs($token) {
    $result = mysqli_query($token, "SELECT * FROM messages WHERE state=0 ORDER BY date");

    return get_msgs($token, $result);
  }

  function get_msgs_for_page($token, $active_page) {
    $b = $active_page * 10 - 10;
    $result = mysqli_query($token, "SELECT * FROM messages WHERE state=1 ORDER BY date_publish DESC LIMIT $b, 10");

    return get_msgs($token, $result);
  }

  function get_msgs($token, $result) {
    if (!$result) {
      die(mysqli_error($token));
    }

    $messages = array();
    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
      $messages[] = mysqli_fetch_assoc($result);
    }

    return $messages;
  }

  function publish_msg($token, $id) {
    $result = mysqli_query($token, "UPDATE messages SET date_publish=now(), state=1 WHERE id=$id AND state=0");
    $count = mysqli_affected_rows($token);

    if (!$result) {
      die(mysqli_error($token));
    }

    if ($count == 0) return false;
    else return true;
  }

  function remove_msg($token, $id) {
    $result = mysqli_query($token, "DELETE FROM messages WHERE id=$id AND state=0");
    $count = mysqli_affected_rows($token);

    if (!$result) {
      die(mysqli_error($token));
    }

    if ($count == 0) return false;
    else return true;
  }

  function new_msg($token, $user_name, $email, $msg) {
    $sql = "INSERT INTO messages (id, name, email, msg, date, date_publish, state)
    VALUES (NULL, '%s', '%s', '%s', now(), NULL, 0)";

    $query = sprintf($sql, mysqli_real_escape_string($token, $user_name),
                           mysqli_real_escape_string($token, $email),
                           mysqli_real_escape_string($token, $msg));

    $result = mysqli_query($token, $query);
    $count = mysqli_affected_rows($token);

    if (!$result || $count == 0) {
      die(mysqli_error($token));
      return false;
    } else return true;
  }
?>
