<?php

require "functions.php";

// set default time zone
date_default_timezone_set("Australia/Melbourne");

// get uni user id
session_start();
$uni_user_id = $_SESSION['user']['uni_user_id'];

// create uni post id
$uni_post_id = uniqid();

$title = $_POST['title'];
$type = $_POST['type'];
$content = $_POST['content'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$address = $_POST['address'];
$post_date = date('Y-m-d H:i:s');

// get file
$file = $_FILES["image"];

// create json for api parameter
$parameter = [
    'uni_post_id' => $uni_post_id,
    'post_date' => $post_date,
    'uni_user_id' => $uni_user_id,
    'title' => $title,
    'type' => $type,
    'content' => $content,
    'latitude' => $latitude,
    'longitude' => $longitude,
    'address' => $address
];

// upload image to S3 and add post information to DynamoDB
$S3Result = uploadImage($uni_post_id, $file['tmp_name'], $file['type']);
$DynamoDBResult = dynamoDBOperation("insertPost", $parameter);

if($S3Result == "Add_Image_Success" && $DynamoDBResult['ResponseMetadata']['HTTPStatusCode'] == 200){
    $postMessage = "Post Success.";
    header("location:index.php?postMessage=$postMessage");
}else{
    $postMessage = "Post Failed.";
    header("location:index.php?postMessage=$postMessage");
}

?>