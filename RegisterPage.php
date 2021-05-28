<!DOCTYPE html>
<html lang="de">
<head>
    <title>Registrieren</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include("MenuBar.php");
?>
<form method="post" action="RegisterHandling.php" id="register">
    <input id="fUsername" name="fUsername" class="inputTextbox" type="text" placeholder="Benutzername"><br>
    <input id="fPassword" class="inputTextbox" name="fPassword" type="password" placeholder="Passwort"><br>
    <input id="fEmail" class="inputTextbox" name="fEmail" type="text" placeholder="E-Mail"><br>

    <input type="submit" value="Registrieren" name="registerButton" class="submitButton" id="registerButton">
</form>
</body>

</html>