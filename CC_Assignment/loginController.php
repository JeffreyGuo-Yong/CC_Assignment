<?php

session_start();

require "functions.php";

$username = $_POST['username'];
$password = $_POST['password'];

$result = login($username, $password);
$parameter = [
    'id' => $result
];

if($result != "Login_Failed"){
    $user = getQueryResult("user", $parameter);
    $_SESSION['user'] = $user;
    header("location:index.php");
}else{
    header("location:login.php?message=Login Failed");
}


?>