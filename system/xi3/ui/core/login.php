<?php

// Starting session
if (! isset($_SESSION))
    session_start();

$host = $_SERVER['HTTP_HOST'];
$hostSubDir = "ui";
$url = "http://".$host."/".$hostSubDir;

// Check if the user is already logged in, if yes then redirect him to welcome page
if (! isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {

    header("location: $url/signin.php");
    exit();

}
else
{

    //----------------------Check Session Timeout---------------------//
    // Ending a session in 2 hours from the last action time.
    $expire = $_SESSION['logintime'] + (2 * 60 * 60);

    // Checking the time now when last action happens.
    $now = time();

    if ($now > $expire) {

        session_destroy();
        header("Location: $url/signin.php");
        exit();

    } else {

        $_SESSION['logintime'] = time(); // update time.
        // do the request url
    }

    //else do requested url

}
