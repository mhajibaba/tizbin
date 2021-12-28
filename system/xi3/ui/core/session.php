<?php

// Starting session
if (!isset($_SESSION))
    session_start();

$host = $_SERVER['HTTP_HOST'];
$hostSubDir = "easydemand/";
$home = "http://" . $host . "/" . $hostSubDir;

if (isset($_SESSION['data'])) {

    // Ending a session in 30 minutes from the last action time.
    $expire = $_SESSION['last_action'] + (30 * 60);

    // Checking the time now when last action happens.
    $now = time(); 
    if ($now > $expire) {
        session_destroy();
        header("Location: $home");
        exit();
    } else {
        $_SESSION['last_action'] = time(); // update time.
        // do the request url
    }
} else {

    if ($_POST['action'] == 'new') {

        $_SESSION['data'] = 1;
        $_SESSION['last_action'] = time(); // Taking now logged in time.

        $startPage = "http://" . $host . "/" . $hostSubDir . "person";
        header("Location: $startPage");
        exit();
    } else {

        header("Location: $home");
        exit();
    }
}

?>
