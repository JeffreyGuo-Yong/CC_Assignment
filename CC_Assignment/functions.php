<?php

// require aws composer and database information
require "aws/aws-autoloader.php";
require "databaseInfo.php";

/* ----------------------------- RDS functions ----------------------------- */

function getConnection(){
    $con = new mysqli(serverName, username, passowrd, databaseName);
    return $con;
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

/* ----------------------------- S3 functions ----------------------------- */

// get S3 Client for use S3 storage
function getS3Client(){
    // get credentials
    $credentials = new Aws\Credentials\Credentials(access_key, secret_key);

    // get S3 Client
    $s3 = new Aws\S3\S3Client([
        'version' => 'latest',
        'region' => REGION,
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

/* ----------------------------- DynamoDB functions ----------------------------- */

/*
 * use aws api gateway and lambda to replace the aws sdk php
 * save all url into the 'databaseInfo.php'
 * use the url to access aws api gateway, then the api call lambda function and return query result
 */

/*
 * this function is used to get scan result from dynamoDB
 * parameter: type control the function use which url
 * for example: type = post, use the 'getAllPost' url to get the scan result from table 'CC_Post'
 */
function getScanResult($type){
    // create guzzle http to send request
    $client = new \GuzzleHttp\Client();

    // create request
    if($type == "post"){
        $request = new \GuzzleHttp\Psr7\Request('GET', GETALLPOST);
    }

    // get response
    $response = $client->send($request);

    // get response body
    $body = $response->getBody();

    // decode json array to object array
    $result = json_decode($body, true);

    return $result;
}

/*
 * this function is used to get query result from dynamoDB
 * parameters:
 * type control the function use which url
 * parameter is the parameter for 'GET' request
 */
function getQueryResult($type, $parameter){
    // create guzzle http to send request
    $client = new \GuzzleHttp\Client();

    // create request
    if($type == "post"){
        $request = new \GuzzleHttp\Psr7\Request('GET', GETPOSTBYID, $parameter);
    }else if ($type == "user"){
        $request = new \GuzzleHttp\Psr7\Request('GET', GETUSERBTID, $parameter);
    }else if($type == "postType"){
        $request = new \GuzzleHttp\Psr7\Request('GET', GETPOSTBYTYPE, $parameter);
    }

    // get response
    $response = $client->send($request);

    // get response body
    $body = $response->getBody();

    // decode json array to object array
    $result = json_decode($body, true);

    return $result;
}

/*
 * this function is used to get insert, update, delete result from dynamoDB
 * parameters:
 * type control the function use which url
 * parameter is the parameter for 'GET' request
 */
function dynamoDBOperation($type, $parameter){
    // create guzzle http to send request
    $client = new \GuzzleHttp\Client();

    // create request
    if($type == "insertUser"){
        $request = new \GuzzleHttp\Psr7\Request('GET', INSERTUSER, $parameter);
    }else if ($type == "insertPost"){
        $request = new \GuzzleHttp\Psr7\Request('GET', INSERTPOST, $parameter);
    }

    // get response
    $response = $client->send($request);

    // get response body
    $body = $response->getBody();

    // decode json array to object array
    $result = json_decode($body, true);

    return $result;
}

/*
 * this function for send message to phone number or email address
 * parameters:
 * 'type' control the type of message. phone or email
 * 'parameter' includes all message:
 *      phone message includes 'phone number' and 'content';
 *      email message includes 'email address' and 'content';
 */
function sendMessage($type, $parameter){
    // create guzzle http to send request
    $client = new \GuzzleHttp\Client();

    // create request
    if($type == "phone"){
        $request = new \GuzzleHttp\Psr7\Request('GET', SENDSMS, $parameter);
    }

    // get response
    $response = $client->send($request);

    // get response body
    $body = $response->getBody();

    // decode json array to object array
    $result = json_decode($body, true);

    return $result;
}

?>
