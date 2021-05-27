<?php
include_once("SignIn.php");
$username = $_POST["fUsername"];
$password = $_POST["fPassword"];
$email = $_POST["fEmail"];

register($username, $password, $email);
header("location:index.php");
