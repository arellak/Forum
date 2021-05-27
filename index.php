<!DOCTYPE html>
<html lang="de">
<head>
    <title>Forum</title>
    <meta charset="utf-8">
</head>
<body>
<p id="nameParagraph"></p>

<form method="post" id="registerForm" action="RegisterPage.php">
    <input type="submit" id="registerButton" name="registerButton" value="Register">
</form>

<form method="post" id="loginForm" action="LoginPage.php">
    <input type="submit" id="loginButton" name="loginButton" value="Login">
</form>

<form method="post" id="createPostForm" action="CreatePostPage.php">
    <input type="submit" id="createPost" name="createPost" value="Create Post">
</form>


<br>
<h2>Posts</h2>
<br>

<div id="postDiv">

</div>

<!--
<form method="post" id="accountForm" action="AccountInformations.php">
    <input type="submit" id="accountButton" name="accountButton" value="Account">
</form>

<form method="post" id="logoutForm" action="index.php">
    <input type="submit" id="logoutButton" name="logoutButton" value="Logout">
</form>
-->

<script>
    let accountNameElement = document.getElementById("nameParagraph");
    let accountName =
        "<?php
            include_once("SignIn.php");
            include_once("User.php");

            $user = User::getUserBySessionId();

            if($user != null) {
                echo $user->name;
            } else {
                echo "Please login";
            }
        ?>";
    let cookieIsSet = "<?php
        echo session_id() != null;
        ?>";

    accountNameElement.innerHTML = accountName;

    if(accountName === "") {
        accountNameElement.innerHTML = "";
    } else {
        accountNameElement.innerHTML = "Logged in as: ".concat(accountName);
    }

    if(cookieIsSet) {
        changeMenuElements("Account", "Logout", "AccountInformations.php", "Logout.php");
    } else {
        changeMenuElements("Register", "Login", "RegisterPage.php", "LoginPage.php")
    }

    function changeMenuElements(firstValue, secondValue, firstAction, secondAction) {
        document.getElementById("registerButton").value = firstValue;
        document.getElementById("loginButton").value = secondValue;

        document.getElementById("registerForm").action = firstAction;
        document.getElementById("loginForm").action = secondAction;
    }

    /**
     * POST SECTION
     */

    let posts = "<?php
        include_once("Post.php");
        $postArray = Post::getAllPosts();
        echo $postArray;
    ?>";

    let postDiv = document.getElementById("postDiv");
    for(let element of posts.split("#")) {
        let elementSplit = element.split(";");
        if(element[1] === undefined) {
            continue;
        }

        let label = document.createElement("a");
        label.innerHTML = elementSplit[1]; // title of the Post
        label.href = "PostPage.php?id=" + elementSplit[0];
        postDiv.append(label);
        postDiv.append(document.createElement("br"));
    }

</script>

</body>
</html>