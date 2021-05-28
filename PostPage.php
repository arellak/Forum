<!DOCTYPE html>
<html lang="de">
<head>
    <title>Beitrag</title>
    <meta charset="utf-8">
</head>
<body>
<?php
include_once("MenuBar.php");
include_once("CustomPost.php");
include_once("User.php");
include_once("Comment.php");

$postId = $_GET["id"];
$post = CustomPost::getPostById($postId);

$user = User::getUserBySessionId();

$title = $post->title;
$content = $post->content;
$author = "von: " . User::loadDataById($post->author)->name;

$showDeleteButton = "";

if($post->author !== $user->id) {
    $showDeleteButton = "visibility:hidden;";
}
?>

<h1 class="postHeader"><?=$title?></h1>
<hr>
<p id="content">
    <?=$content?>
</p>

<br>
<p id="author"><?=$author?></p>
<br>

<form method="post" action="DeletePost.php" id="deletePostForm" style="<?=$showDeleteButton?>">
    <input type="hidden" id="postId" name="postId" value="<?=$postId?>" readonly>
    <input type="submit" id="deletePost" value="Löschen" name="deletePost">
</form>

<form method="post" action="CreateCommentAction.php" id="commentForm">
    <input type="hidden" id="postId" name="postId" value="<?=$postId?>" readonly>
    <input type="text" placeholder="Inhalt" name="commentField" id="commentField" class="inputTextbox">
    <input type="submit" value="Kommentieren" id="commentButton" name="commentButton" class="submitButton">
</form>

<div id="commentDiv">
    <h2 class="commentHeader">Kommentare</h2>
    <?php
    include_once("Comment.php");
    $postId = $_GET["id"];

    $comments = Comment::getAllComments($postId);
    foreach($comments as $comment) {
        echo "<p id='commentAuthor'>$comment->authorName</p>";
        echo "<p id='commentContent'>$comment->content</p>";
    }
    ?>
</div>

</body>
</html>