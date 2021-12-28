<?php

// Starting session
if (! isset($_SESSION))
    session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

    session_unset();
    session_destroy();
}

$host = $_SERVER['HTTP_HOST'];
$hostSubDir = "ui/";
$url = "http://".$host."/".$hostSubDir;

header("location: ".$url."signin.php");


exit();

?>
