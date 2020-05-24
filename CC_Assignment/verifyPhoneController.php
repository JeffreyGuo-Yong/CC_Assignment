<?php
session_start();
require "functions.php";

// get phone number and format phone number
$phone = $_GET['phone'];
$phoneNumber = "+61" . substr($phone,1);

// create verify code and save code to session
$code = rand(10000, 99999);
$_SESSION['phoneVerifyCode'] = $code;

// create content
$content = "Thanks for you register, you verify code is " . $code;

// create parameter
$parameter = [
    "phone" => $phoneNumber,
    "content" => $content
];

// send SMS to phone
$result = sendMessage("phone", $parameter);

if($result['ResponseMetadata']['HTTPStatusCode'] == 200){
    $message = "phone verify code send success";
    header("location:register.php?verifyPhone=" . $message);
}else{
    $message = "phone verify code send failed";
    header("location:register.php?verifyPhone=" . $message);
}
?>