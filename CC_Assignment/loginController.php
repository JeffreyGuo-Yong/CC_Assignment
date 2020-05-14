<?php

session_start();

require "functions.php";

$username = $_POST['username'];
$password = $_POST['password'];

$result = login($username, $password);

if($result != "Login_Failed"){
    $user = getUser($result);
    $_SESSION['user'] = $user;
    header("location:index.php");
}else{
    header("location:login.php?message=Login Failed");
}


?>