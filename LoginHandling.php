<?php
include_once("SignIn.php");
try {
    $username = htmlspecialchars($_POST["fUsername"], ENT_QUOTES, "UTF-8");;
    $password = htmlspecialchars($_POST["fPassword"], ENT_QUOTES, "UTF-8");

    login($username, $password);
} catch(Exception $e) {
    echo $e->getMessage();
}