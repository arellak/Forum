<?php
include_once("Database.php");
include_once("User.php");
include_once("SignIn.php");

try {
    $title = $_POST["titleTf"];
    $content = $_POST["contentTf"];
    createPost($title, $content);
    header("location:index.php");
} catch(Exception $e) {
    echo $e->getMessage();
}

function createPost($title, $content) {
    $db = new Database("forum.db");
    $db->connect();
    createPostTable();

    session_start();

    $currentDate = new DateTime();

    $insert = "insert into posts(authorId, title, content, creationDate) values (:authorId, :title, :content, :creationDate)";
    $stmt = $db->pdo->prepare($insert);
    $userId = getUserIdBySessionID(session_id());

    $stmt->bindValue(":authorId", $userId);
    $stmt->bindValue(":title", $title);
    $stmt->bindValue(":content", $content);
    $stmt->bindValue(":creationDate", $currentDate->format("d.m.Y-H:i:s"));
    $stmt->execute();

    $db->close();

    User::updatePostCount();
}

function createPostTable() {
    $db = new Database("forum.db");
    $db->connect();
    $postTable = "create table if not exists posts(
        id integer primary key,
        authorId integer not null,
        title text not null,
        content text not null,
        creationDate text not null
    )";
    $stmt = $db->pdo->prepare($postTable);
    $stmt->execute();
    $db->close();
}