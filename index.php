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
include_once("User.php");
include_once("Comment.php");

function createAllTables() {
    User::createUserTable();
    CustomPost::createPostTable();
    Comment::createCommentTable();

    $db = new Database("forum.db");
    $db->connect();

    $loginIdTable = "create table if not exists userIDs(
        uuid unique not null,
        userId int not null
    );";

    $stmt = $db->pdo->prepare($loginIdTable);
    $stmt->execute();
}
createAllTables();

$posts = CustomPost::getAllPosts();

echo "<h2 id='contentHeader'>Beiträge</h2>";

foreach($posts as $post) {
    echo "<a href='PostPage.php?id=$post->id' id='postLink'>$post->title von $post->author</a><br>";
}
?>


</body>
</html>
