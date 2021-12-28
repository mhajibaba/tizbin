<?php
include 'core/session.php';

require_once ('stripe/vendor/autoload.php');

try {
    
    $reqid = $_GET['req'];
    if ($reqid != $_SESSION["request"]) {
        header("Location: download?fails");
        exit();
    }

    $_SESSION["request"] = '';

    $pkeys = include('core/payment_keys.php');
    
    // Set your secret key. 
    \Stripe\Stripe::setApiKey($pkeys['sk_live']);

    // Fetch the Checkout Session to display the JSON result on the success page
    $id = $_GET['session_id'];
    $checkout_session = \Stripe\Checkout\Session::retrieve($id);

    include_once 'core/db/tb_order.php';

    $res = TableOrder::add(json_encode($checkout_session));
    // echo json_encode($checkout_session);

    if ($res) {

        if($_SESSION["item"] == $pkeys['sku_live_pdf_2.99']) {
            
            $_SESSION["paidp"] = true;
            $_SESSION["paidw"] = false;
        }
        else {
            
            $_SESSION["paidw"] = true;
            $_SESSION["paidp"] = false;
        }

        header("Location: finish?d");
        exit();
        
    } else {
        
        header("Location: download?fails");
        exit();
    }
} catch (\Exception $e) {
    // Invalid payload
    $fail = "http://" . $host . "/" . $hostSubDir . "download?fails";
    header("Location: $fail");
    exit();
}

?>