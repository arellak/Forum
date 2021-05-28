<!DOCTYPE html>
<html lang="de">
<head>
    <title>Account Information</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include_once("MenuBar.php");
        include_once("User.php");
        include_once("SignIn.php");

        session_start();
        $userId = getUserIdBySessionID(session_id());
        $user = User::loadDataById($userId);

        if ($user != null) {
            $username = $user->name;
            $email = $user->email;
            $registrationDate = $user->registrationDate;
            $postCount = $user->postCount;
        }

    ?>

    <p>ID: <label id="userID"><?=$userId?></label></p>
    <p>E-Mail: <label id="email"><?=$email?></label></p>
    <p>Benutzername: <label id="username"><?=$username?></label></p>
    <p>Registrierungs Datum: <label id="registrationDate"><?=$registrationDate?></label></p>
    <p>Anzahl der Beiträge: <label id="postCount"></label><?=$postCount?></p>

    <form method="post" action="DeleteUser.php" id="deleteUserForm">
        <input type="submit" value="Löschen" id="deleteUser" name="deleteUser" class="submitButton">
    </form>
</body>
</html>