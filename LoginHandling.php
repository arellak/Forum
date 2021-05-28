<?php
include_once("SignIn.php");
try {
    $username = $_POST["fUsername"];
    $password = $_POST["fPassword"];

    login($username, $password);
} catch(Exception $e) {
    echo $e->getMessage();
}