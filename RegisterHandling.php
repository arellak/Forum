<?php
include_once("SignIn.php");
$username = htmlspecialchars($_POST["fUsername"], ENT_QUOTES, "UTF-8");
$password = htmlspecialchars($_POST["fPassword"], ENT_QUOTES, "UTF-8");
$email =  htmlspecialchars($_POST["fEmail"], ENT_QUOTES, "UTF-8");

if($username === "" || $password === "" || $email === "") {
    header("location:RegisterPage.php");
}

if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
    register($username, $password, $email);
    header("location:index.php");
} else {
    header("location:RegisterPage.php");
}
