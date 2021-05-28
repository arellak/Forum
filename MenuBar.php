<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include_once("User.php");
$isLoggedIn = 0;

try {
    $isLoggedIn = User::getUserBySessionId() !== null;
} catch(Exception $e) {

}

$registerValue = "";
$registerForm = "";

$loginValue = "";
$loginForm = "";

$accountName = "";
$accountNameVisible = "";

$registerHiddenStyle = "";

if($isLoggedIn) {
    $registerValue = "Beitrag erstellen";
    $registerForm = "CreatePostPage.php";

    $loginValue = "Abmelden";
    $loginForm = "Logout.php";

    $accountName = User::getUserBySessionId()->name;
    $accountNameVisible = "";
} else {
    $registerValue = "Registrieren";
    $registerForm = "RegisterPage.php";

    $loginValue = "Anmelden";
    $loginForm = "LoginPage.php";

    $accountName = "";
    $accountNameVisible = "visibility:hidden;";
}

?>
<div id="menuDiv">
    <ul id="menubar">
        <li id="menubarListItem">
            <form method="post" action="index.php" id="mainmenuForm">
                <input type="submit" class="menuItem" id="mainmenuButton" name="mainmenuButton" value="Startseite">
            </form>
        </li>

        <li id="menubarListItem" style="<?=$registerHiddenStyle?>">
            <form method="post" id="registerForm" action="<?=$registerForm?>">
                <input type="submit" class="menuItem" id="registerButton" name="registerButton" value="<?=$registerValue?>">
            </form>
        </li>

        <li id="menubarListItem" style="float: right;">
            <form method="post" id="loginForm" action="<?=$loginForm?>">
                <input type="submit" class="menuItem" id="loginButton" name="loginButton" value="<?=$loginValue?>">
            </form>
        </li>

        <li id="menubarListItem" style="float:right; <?=$accountNameVisible?>">
            <form method="post" action="AccountInformations.php" id="accountInformationForm">
                <input type="submit" class="menuItem" id="accountName" value="<?=$accountName?>">
            </form>
        </li>
    </ul>
</div>

</body>
</html>