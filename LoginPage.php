<!DOCTYPE html>
<html lang="de">
<head>
    <title>Login</title>
</head>
<body>
<form method="post" action="LoginPage.php" id="login">
    <label for="fUsername">Username:</label><br>
    <input id="fUsername" name = "fUsername" type="text" placeholder="Username"><br>

    <label for="fPassword">Password:</label><br>
    <input id="fPassword" name = "fPassword" type="password" placeholder="Password"><br>

    <input type="submit" value="Login" id="loginButton">
</form>

</body>

</html>
<?php
include("SignIn.php");

$username = $_POST["fUsername"];
$password = $_POST["fPassword"];

// setcookie("anna", "", time()+10, "/");
login($username, $password);