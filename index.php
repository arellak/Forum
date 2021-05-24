<!DOCTYPE html>
<html lang="de">
<head>
    <title>Forum</title>
    <meta charset="utf-8">
</head>
<body>

<form method="post" id="registerForm" action="RegisterPage.php">
    <input type="submit" id="registerButton" name="registerButton" value="Register">
</form>

<form method="post" id="loginForm" action="LoginPage.php">
    <input type="submit" id="loginButton" name="loginButton" value="Login">
</form>

<form method="post" id="accountForm" action="AccountInformations.php">
    <input type="submit" id="accountButton" name="accountButton" value="Account">
</form>

<form method="post" id="logoutForm" action="index.php">
    <input type="submit" id="logoutButton" name="logoutButton" value="Logout">
</form>

<p>Accountname: <label id="accountName"></label></p>

<script>
    let accountNameElement = document.getElementById("accountName");
    let accountName =
        "<?php
            $accountName = $_COOKIE["accountName"];
            if(isset($accountName)) {
                echo $accountName;
            } else {
                echo "Please login";
            }
        ?>";
    let cookieIsSet = "<?php
        echo isset($_COOKIE["accountName"]);
        ?>";


    accountNameElement.innerHTML = accountName;

    if(cookieIsSet) {
        document.getElementById("registerButton").style = "visibility: hidden;";
        document.getElementById("loginButton").style = "visibility: hidden;";
        document.getElementById("accountButton").style = "";
        document.getElementById("logoutButton").style = "";
    } else {
        document.getElementById("registerButton").style = "";
        document.getElementById("loginButton").style = "";
        document.getElementById("accountButton").style = "visibility: hidden;";
        document.getElementById("logoutButton").style = "visibility: hidden;";
    }
</script>

</body>
</html>


<?php

include("SignIn.php");

if(isset($_COOKIE["accountName"]) && isset($_POST["logoutButton"])) {
    logout();
    header("Refresh:1");
}