<?php

include_once("CustomPost.php");

try {
    $title = $_POST["titleTf"];
    $content = $_POST["contentTf"];

    if($title !== "" && $content !== "") {
        CustomPost::createPost($title, $content);
    }

    header("location:index.php");
} catch(Exception $e) {
    echo $e->getMessage();
}