<?php

# API for accessing database dynamically.
$encoding = "UTF-8";

# Send data or error information back.
function feedback($arr){
    die(json_encode($arr));
}

function intError($error, $text){
    feedback(array(
        'error' => $error,
        'text' => $text
    ));
}

# Connecting to database.
$host = "localhost";
# File with database connection settings (login, psw).
# Should be excluded from project view.
require_once "db_conf.dsf";
$dbname = "twins_practice";

$mysql = mysqli_connect($host,$user,$pass,$dbname);

if (mysqli_connect_errno()){
    intError(1, 'Database connection error');
}

session_start();

$requestString = $_SESSION['usertype'].'-'.$_POST['request'];

switch($requestString){
    # Update list
    case 'public-update':
        # Fetching all approved posts
        if ($result = $mysql->query("
            SELECT 
                `comments`.`msg` as `msg`, 
                `users`.`name` as `author`, 
                `users`.`mail` as `email`, 
                `comments`.`timestamp` as `msg_timestamp`
            FROM `users` INNER JOIN `comments` ON `users`.`id` = `comments`.`users_id`
            WHERE `comments`.`approved` = TRUE
            ORDER BY `comments`.`timestamp` DESC
        ")){
            feedback(array(
                'error' => 0,
                'data' => $result->fetch_all(MYSQLI_ASSOC),
                'timestamp' => time()
            ));
        } else {
            intError(1, 'Database error: '.$mysql->error);
        }
        break;
    # New comment
    case 'public-comment':
        # Checking input        
        $name = $_POST['name'];
        $mail = $_POST['email'];
        $msg = $_POST['text'];
        
        if (!preg_match('/^[a-zA-Zа-яА-ЯёЁ0-9]+$/', $name)) {
            $error = 1;
            $text = 'Неккоретные символы в имени';
        }
        $len = mb_strlen($name, $encoding);
        if ($len > 255 || $len < 3){
            $error = 2;
            $text = 'Длина имени находится вне диапазона 3-255';
        }
        if (!preg_match('/^[\w.]+@\w+\.\w+$/', $mail)){
            $error = 3;
            $text = 'Неккоретный формат почтового адреса';
        }
        $len = mb_strlen($msg, $encoding);
        if ($len > 512 || $len < 4) {
            $error = 4;
            $text = 'Длина сообщения находится вне диапазона 4-512';
        }
        
        # Feedback.
        if ($error > 0){
            feedback(array(
                'error' => 100 + $error,
                'text' => $text
            ));
        }
        
        # Adding data.
        # Adding user if not exists.
        $result = $mysql->query("SELECT `id` FROM `users` WHERE `mail` LIKE '$mail'");
        if (!$result)intError(2, 'Database error: '.$mysql->error);
        if ($row = $result->fetch_row()){
            $userId = $row[0];
        } else {
            // user does not exist
            if (!$mysql->query("INSERT INTO `users` (`name`, `mail`) VALUES ('$name','$mail')"))
                intError(3, 'Database error: '.$mysql->error);
            $userId = $mysql->insert_id;
        }
        # Adding comment
        if (!$mysql->query("INSERT INTO `comments` (`users_id`, `msg`) VALUES ($userId, '$msg')"))
            intError(4, 'Database error: '.$mysql->error);
        
        # Feedback
        feedback(array(
            'error' => 0,
            'data' => null,
            'timestamp' => time()
        ));
        break;
    # Update list
    case 'admin-update':
        # Fetching all posts
        if ($result = $mysql->query("
            SELECT
                `comments`.`id` as `comment_id`,
                `comments`.`msg` as `msg`, 
                `users`.`name` as `author`, 
                `users`.`mail` as `email`, 
                `comments`.`timestamp` as `msg_timestamp`
            FROM `users` INNER JOIN `comments` ON `users`.`id` = `comments`.`users_id`
            ORDER BY `comments`.`timestamp` DESC
        ")){
            feedback(array(
                'error' => 0,
                'data' => $result->fetch_all(MYSQLI_ASSOC),
                'timestamp' => time()
            ));
        } else {
            intError(5, 'Database error: '.$mysql->error);
        }
        break;
    # Discard comment
    case 'admin-delete':
        $commentId = $_POST['comment_id'];
        if ($mysql->query("DELETE FROM `comments` WHERE `id` = $commentId"))
            feedback(array(
                'error' => 0,
                'data' => null,
                'timestamp' => time()
            ));
        else
            intError(6, 'Database error: '.$mysql->error);
        break;
    # Approve comment
    case 'admin-approve':
        $commentId = $_POST['comment_id'];
        if ($mysql->query("UPDATE `comments` SET `approved` = TRUE WHERE `id` = $commentId"))
            feedback(array(
                'error' => 0,
                'data' => null,
                'timestamp' => time()
            ));
        else
            intError(7, 'Database error: '.$mysql->error);
        break;
}

?>