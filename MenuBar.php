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
$avatar = "";

$registerValue = "";
$registerForm = "";

$loginValue = "";
$loginForm = "";

$accountName = "";
$visibility = "";

$registerHiddenStyle = "";

if($isLoggedIn) {
    $registerValue = "Beitrag erstellen";
    $registerForm = "CreatePostPage.php";

    $loginValue = "Abmelden";
    $loginForm = "Logout.php";

    $user = User::getUserBySessionId();

    $accountName = $user->name;
    $accountNameVisible = "";
    $avatar = $user->avatar;
} else {
    $registerValue = "Registrieren";
    $registerForm = "RegisterPage.php";

    $loginValue = "Anmelden";
    $loginForm = "LoginPage.php";

    $accountName = "";
    $visibility = "visibility:hidden;";
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

        <li id="menubarListItem" style="float:right; <?=$visibility?>">
            <form method="post" action="AccountInformations.php" id="accountInformationForm">
                <input type="submit" class="menuItem" id="accountName" value="<?=$accountName?>">
            </form>
        </li>
    </ul>
</div>

</body>
</html>