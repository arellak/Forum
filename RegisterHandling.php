<?php
include_once("SignIn.php");
$username = $_POST["fUsername"];
$password = $_POST["fPassword"];
$email = $_POST["fEmail"];

if($username === "" || $password === "" || $email === "") {
    header("location:RegisterPage.php");
}

if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
    register($username, $password, $email);
    header("location:index.php");
} else {
    header("location:RegisterPage.php");
}
