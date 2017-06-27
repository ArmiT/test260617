<?php

# Connecting to database.
$host = "localhost";
$user = "user";
$pass = "password";
$dbname = "twins_practice";

$mysql = mysqli_connect($host,$user,$pass,$dbname);

if (mysqli_connect_errno()){
    http_response_code(500);
    die("MySQL connection failed.");
}

session_start();

# Settings.
# html pages location.
$html = "html/";

# Routing.
switch($_GET["mode"]){
    case "public":
        $type = "public";
        break;
    case "admin":
        $type = "admin";
        break;
}

$_SESSION['usertype'] = $type;

# Calling appropriate script.
require_once $type.".php";

# Displaying.
require_once $html.$type.".html";

?>