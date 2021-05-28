<!DOCTYPE html>
<html lang="de">
<head>
    <title>Beitrag erstellen</title>
    <meta charset="utf-8">
</head>
<body>

<?php
include_once("MenuBar.php");
?>

<form method="post" action="PostAction.php" id="creatPostForm">
    <label for="titleTf"></label><input type="text" class="inputTextbox" id="titleTf" name="titleTf" placeholder="Titel"><br>
    <label for="contentTf"></label><input type="text" class="inputTextbox" id="contentTf" name="contentTf" placeholder="Inhalt"><br>
    <br>
    <input type="submit" value="Erstellen" class="submitButton" id="createPost" name="createPost">
</form>
</body>
</html>
