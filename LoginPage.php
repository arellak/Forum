<!DOCTYPE html>
<html lang="de">
<head>
    <title>Login</title>
</head>
<body>
<?php
include_once("MenuBar.php");
?>

<form method="post" action="LoginHandling.php" id="loginForm">
    <input id="fUsername" class="inputTextbox" name ="fUsername" type="text" placeholder="Benutzername"><br>

    <input id="fPassword" class="inputTextbox"  name ="fPassword" type="password" placeholder="Passwort"><br>

    <input type="submit" value="Login" name="loginButton" id="loginButton" class="submitButton">
</form>


</body>

</html>