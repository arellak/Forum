<?php

include_once("CustomPost.php");

try {
    $title = htmlspecialchars($_POST["titleTf"], ENT_QUOTES, "UTF-8");
    $content = htmlspecialchars($_POST["contentTf"], ENT_QUOTES, "UTF-8");

    if($title !== "" && $content !== "") {
        CustomPost::createPost($title, $content);
        header("location:index.php");
    } else {
        header("location:CreatePostPage.php");
    }
} catch(Exception $e) {
    echo $e->getMessage();
}