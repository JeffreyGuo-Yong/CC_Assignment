<?php

require "functions.php";

$nickname = $_POST['nickname'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$room = $_POST['room'];
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$notificationType = $_POST['notificationType'];

$uni_user_id = uniqid();

// add login information to RDS and add all user information to DynamoDB
$RDS_result = registerRDS($uni_user_id, $email, $phone, $password);
$DynamoDB_result = registerDynamoDB($uni_user_id, $nickname, $name, $email, $phone, $password, $room, $street, $city, $state, $notificationType);

if($RDS_result == "RDS_Success" && $DynamoDB_result == "DynamoDB_Success"){
    $registerMessage = "Register Success.";
    header("location:index.php?registerMessage=$registerMessage");
}else{
    $registerMessage = "Register Failed.";
    header("location:index.php?registerMessage=$registerMessage");
}

?>