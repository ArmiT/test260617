<?php

session_start();

# Settings.
# html pages location.
$html = "html/";

# Routing.
if (!isset($_GET["mode"])){
    header("Location: html/errors/404.html");
    exit;
}
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