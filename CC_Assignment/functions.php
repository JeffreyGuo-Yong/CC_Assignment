<?php

// require aws composer and database information
require "aws/aws-autoloader.php";
require "databaseInfo.php";

// use the dynamoDbException
use Aws\DynamoDb\Exception\DynamoDbException;

// set default time zone
date_default_timezone_set("Australia/Melbourne");

function getConnection(){
    $con = new mysqli(serverName, username, passowrd, databaseName);
    return $con;
}

// get sdk for dynamoDB
function getSDK(){
    // get credentials
    $credentials = new Aws\Credentials\Credentials(access_key, secret_key);

    // get SDK
    $sdk = new Aws\Sdk([
        'version' => 'latest',
        'region' => 'ap-southeast-2',
        'credentials' => $credentials
    ]);

    // get SDK
    return $sdk;
}

function registerRDS($uni_user_id, $email, $phone, $password){
    $con = getConnection();
    $sql = "insert into login (uni_user_id, email, phone, password) values ('$uni_user_id', '$email', '$phone', '$password')";

    if(mysqli_query($con, $sql)){
        $con->close();
        return "RDS_Success";
    }else{
        $con->close();
        return "RDS_Failed";
    }
}

function registerDynamoDB($uni_user_id, $nickname, $name, $email, $phone, $password, $room, $street, $city, $state, $notificationType){
    // create dynamoDB object and marsharler
    $dynamoDB = getSDK()->createDynamoDb();
    $marshaler = new Aws\DynamoDb\Marshaler();

    // define the json
    $item = $marshaler->marshalJson('{
        "uni_user_id": "' . $uni_user_id . '",
        "nickname": "' . $nickname . '",
        "name" : "' . $name . '",
        "email": "' . $email . '",
        "phone": "' . $phone . '",
        "password": "' . $password . '",
        "room": "' . $room . '",
        "street": "' . $street . '",
        "city": "' . $city . '",
        "state": "' . $state . '",
        "notificationType": "' . $notificationType . '"
    }');

    // define the parameters
    $parameters = [
        "TableName" => USER_Table,
        "Item" => $item
    ];

    $result = $dynamoDB->putItem($parameters);
    if($result->count() > 0){
        return "DynamoDB_Success";
    }else{
        return "DynamoDB_Failed";
    }
}

function login($username, $password){
    $isEmail = strpos($username,"@");

    if($isEmail !== false){
        $sql = "select uni_user_id from login where email = '$username' and password = '$password'";
    }else{
        $sql = "select uni_user_id from login where phone = '$username' and password = '$password'";
    }

    $con = getConnection();

    $result = $con->query($sql);
    $con->close();

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        return $user['uni_user_id'];
    }else{
        return "Login_Failed";
    }
}

function getUser($uni_user_id){
    // create dynamoDB object and marsharler
    $dynamoDB = getSDK()->createDynamoDb();
    $marshaler = new Aws\DynamoDb\Marshaler();

    $key = $marshaler->marshalJson('{
        "uni_user_id": "' . $uni_user_id . '"
    }');

    $parameters = [
        'TableName' => USER_Table,
        'Key' => $key
    ];

    $result = $dynamoDB->getItem($parameters);

    return $result["Item"];
}

// get S3 Client for use S3 storage
function getS3Client(){
    // get credentials
    $credentials = new Aws\Credentials\Credentials(access_key, secret_key);

    // get S3 Client
    $s3 = new Aws\S3\S3Client([
        'version' => 'latest',
        'region' => 'ap-southeast-2',
        'credentials' => $credentials
    ]);

    // return S3
    return $s3;
}

// upload image to S3
function uploadImage($imageName, $temp_file_location, $imageType){
    $s3 = getS3Client();

    /*
     * set bucket name
     * set file key
     * set file source
     * set file type
     * set 'public-read' for use objectURL to show image on the HTML
     */
    $result = $s3->putObject([
        'Bucket' => BUCKET,
        'Key' => $imageName,
        'SourceFile' => $temp_file_location,
        'ContentType' => $imageType,
        'ACL' => 'public-read'
    ]);

    if($result->count() > 0){
        return "Add_Image_Success";
    }else{
        return "Add_Image_Failed";
    }
}

// use the file key to get the objectURL
function getImageURL($key){
    $s3 = getS3Client();
    return $s3->getObjectUrl(BUCKET, $key);
}

// add post to dynamoDB
function post($uni_post_id, $uni_user_id, $title, $type, $content, $latitude, $longitude, $address){
    // get date and time
    $date = date('Y-m-d H:i:s');

    // create dynamoDB object and marsharler
    $dynamoDB = getSDK()->createDynamoDb();
    $marshaler = new Aws\DynamoDb\Marshaler();

    $item = $marshaler->marshalJson('{
        "uni_post_id": "' . $uni_post_id . '",
        "post_date": "' . $date . '",
        "uni_user_id": "' . $uni_user_id . '",
        "title": "' . $title . '",
        "type": "' . $type . '",
        "content": "' . $content . '",
        "latitude": '. $latitude . ',
        "longitude": ' . $longitude . ',
        "address": "' . $address . '"
    }');

    $parameters = [
        "TableName" => POST_Table,
        "Item" => $item
    ];

    $result = $dynamoDB->putItem($parameters);
    if($result->count() > 0){
        return "Add_Post_Success";
    }else{
        return "Add_Post_Failed";
    }
}

function getPosts(){
    // create dynamoDB object and marsharler
    $dynamoDB = getSDK()->createDynamoDb();

    $parameters = [
        'TableName' => POST_Table
    ];

    $result = $dynamoDB->scan($parameters);

    return $result['Items'];
}

function getPostDetails($uni_post_id){
    // create dynamoDB object and marsharler
    $dynamoDB = getSDK()->createDynamoDb();
    $marshaler = new Aws\DynamoDb\Marshaler();

    $key = $marshaler->marshalJson('{
        ":id": "' . $uni_post_id . '"
    }');

    $parameters = [
        'TableName' => POST_Table,
        'KeyConditionExpression' => '#id = :id',
        'ExpressionAttributeNames' => [ '#id' => 'uni_post_id' ],
        'ExpressionAttributeValues' => $key
    ];

    $result = $dynamoDB->query($parameters);

    return $result['Items'];
}

?>
