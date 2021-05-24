<!DOCTYPE html>
<html lang="de">
<head>
    <title>Account Information</title>
</head>
<body>
    <p>Email: <label id="email"></label></p>
    <p>Username: <label id="username"></label></p>
    <p>Registration Date: <label id="registrationDate"></label></p>
    <p>Post Count: <label id="postCount"></label></p>

    <a href="index.php ">Home</a>

<script>
    let emailElement = document.getElementById("email");
    let usernameElement = document.getElementById("username");
    let registrationDateElement = document.getElementById("registrationDate");
    let postCountElement = document.getElementById("postCount");

    let userInfos = "<?php
            include("User.php");
            $accountName = $_COOKIE["accountName"];
            if (isset($accountName)) {
                try {
                    echo User::loadDataByName($accountName);
                } catch (Exception $e) {
                    echo "Couldn't load User: " . $e->getMessage();
                }
            }
            ?>";

    let userSplitted = userInfos.split(";");
    let username = userSplitted[0];
    let email = userSplitted[1];
    let registrationDate = userSplitted[2];
    let postCount = userSplitted[3];


    usernameElement.innerHTML = username;
    registrationDateElement.innerHTML = registrationDate;
    postCountElement.innerHTML = postCount;
    emailElement.innerHTML = email;
</script>
</body>
</html>

<?php
