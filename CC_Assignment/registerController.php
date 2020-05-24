<?php

session_start();
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

// create uni user id
$uni_user_id = uniqid();

// create json for api parameter
$parameter = [
    'uni_user_id' => $uni_user_id,
    'nickname' => $nickname,
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'password' => $password,
    'room' => $room,
    'street' => $street,
    'city' => $city,
    'state' => $state,
    'notificationType' => $notificationType
];

// add login information to RDS and add all user information to DynamoDB
$RDS_result = registerRDS($uni_user_id, $email, $phone, $password);
$DynamoDB_result = dynamoDBOperation("insertUser", $parameter);

if($RDS_result == "RDS_Success" && $DynamoDB_result['ResponseMetadata']['HTTPStatusCode'] == 200){
    $registerMessage = "Register Success.";
    unset($_SESSION['phoneVerifyCode']);
    header("location:index.php?registerMessage=$registerMessage");
}else{
    $registerMessage = "Register Failed.";
    unset($_SESSION['phoneVerifyCode']);
    header("location:index.php?registerMessage=$registerMessage");
}

?>