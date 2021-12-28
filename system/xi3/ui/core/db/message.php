<?php

include_once 'tb_message.php';

if ($_POST) {

    echo "Table Student created successfully";
    
    // Execute code (such as database updates) here.
    // var_dump($_POST);
    $name = trim(htmlspecialchars($_POST["name"]));
    $email = trim(htmlspecialchars($_POST["email"]));
    $subject = trim(htmlspecialchars($_POST["subject"]));
    $message = trim(htmlspecialchars($_POST["message"]));

    try {

        $res = TableMessage::add($name,$email,$subject,$message);
        
        if($res) {
            header("Location: ../../contact?success");
            exit();
        }else {
            header("Location: ../../contact?connection");
            exit();
        }
        
        
    } catch (Exception $e) {

        header("Location: ../../contact?exception");
        exit();
        //echo "There is some problem in connection: " . $e->getMessage();
    }
} 
?>