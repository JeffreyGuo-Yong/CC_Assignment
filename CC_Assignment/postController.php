<?php

require "functions.php";

// get uni user id
session_start();
$uni_user_id = $_SESSION['user']['uni_user_id']['S'];

// create uni post id
$uni_post_id = uniqid();

$title = $_POST['title'];
$type = $_POST['type'];
$content = $_POST['content'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$address = $_POST['address'];

// get file
$file = $_FILES["image"];

// upload image to S3 and add post information to DynamoDB
$S3Result = uploadImage($uni_post_id, $file['tmp_name'], $file['type']);
$DynamoDBResult = post($uni_post_id, $uni_user_id, $title, $type, $content, $latitude, $longitude, $address);

if($S3Result == "Add_Image_Success" && $DynamoDBResult == "Add_Post_Success"){
    $postMessage = "Post Success.";
    header("location:index.php?postMessage=$postMessage");
}else{
    $postMessage = "Post Failed.";
    header("location:index.php?postMessage=$postMessage");
}

?>