<!DOCTYPE html>
<html lang="de">
<head>
    <title>Forum</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<br>
<?php
include_once("MenuBar.php");
include_once("CustomPost.php");

$posts = CustomPost::getAllPosts();

echo "<h2 id='contentHeader'>Beiträge</h2>";

foreach($posts as $post) {
    echo "<a href='PostPage.php?id=$post->id' id='postLink'>$post->title von $post->author</a><br>";
}

?>


</body>
</html>
