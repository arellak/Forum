<!DOCTYPE html>
<html lang="de">
<head>
    <title>Post</title>
    <meta charset="utf-8">
</head>
<body>
<h2 id="title">%title%</h2>

<p id="content">
    %content%
</p>

<p id="author">%author%</p>

<script>
    let title = document.getElementById("title");
    let content = document.getElementById("content");
    let author = document.getElementById("author");

    let post = "<?php
            include_once("Post.php");
            echo Post::getPostById($_GET["id"]);
        ?>";

    let postSplit = post.split(";");

    let authorName = "<?php
            include_once("Post.php");
            include_once("User.php");
            $post = Post::getPostById($_GET["id"]);
            $user = User::loadDataById($post->author);
            echo $user->name;
        ?>"

    title.innerHTML = postSplit[1];
    content.innerHTML = postSplit[2];
    author.innerHTML = "by: " + authorName;

</script>

</body>
</html>