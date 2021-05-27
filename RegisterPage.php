<!DOCTYPE html>
<html lang="de">
<head>
    <title>Registrieren</title>
</head>
<body>
<form method="post" action="RegisterHandling.php" id="register">
    <label for="fUsername">Username:</label><br>
    <input id="fUsername" name = "fUsername" type="text" placeholder="Username"><br>

    <label for="fPassword">Password:</label><br>
    <input id="fPassword" name = "fPassword" type="password" placeholder="Password"><br>

    <label for="fEmail">E-Mail:</label><br>
    <input id="fEmail" name = "fEmail" type="text" placeholder="E-Mail"><br>

    <input type="submit" value="Register" name="registerButton" id="registerButton">
</form>

<a href="index.php">Home<br></a>
</body>

</html>