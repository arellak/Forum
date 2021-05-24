<!DOCTYPE html>
<html lang="de">
<head>
    <title>Login</title>
</head>
<body>

<form method="post" action="LoginPage.php" id="login">
    <label for="fUsername">Username:</label><br>
    <input id="fUsername" name ="fUsername" type="text" placeholder="Username"><br>

    <label for="fPassword">Password:</label><br>
    <input id="fPassword" name ="fPassword" type="password" placeholder="Password"><br>

    <input type="submit" value="Login" name="loginButton" id="loginButton">
</form>

<a href="index.php">Home<br></a>

</body>

</html>

<?php
include("SignIn.php");

if((!(isset($_COOKIE["accountName"]))) && isset($_POST["loginButton"])) {
    $username = $_POST["fUsername"];
    $password = $_POST["fPassword"];

    login($username, $password);
}
?>