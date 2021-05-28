<?php
include_once("CustomPost.php");

CustomPost::deletePost($_POST["postId"]);
header("location:index.php");