<?php
include_once("Comment.php");
include_once("User.php");

$postId = $_POST["postId"];
$commentAuthor = User::getUserBySessionId();

$content = htmlspecialchars($_POST["commentField"], ENT_QUOTES, "UTF-8");

Comment::create($postId, $commentAuthor->id, $content);

header("location: PostPage.php?id=" . $postId);