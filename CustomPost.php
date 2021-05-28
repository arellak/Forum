<?php

include_once("Database.php");
include_once("SignIn.php");

class CustomPost {

    public $id;
    public $author;
    public $title;
    public $content;

    public $creationDate;

    public function __toString() {
        return $this->id . ";" . $this->title . ";" . $this->content . ";" .$this->author . ";" . $this->creationDate;
    }

    public static function getPostById($id) {
        CustomPost::createPostTable();

        $post = new CustomPost();
        $db = new Database("forum.db");
        $db->connect();

        $select = "select * from posts where id = $id";
        $stmt = $db->pdo->query($select);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post->id = $row["id"];
            $post->author = $row["authorId"];
            $post->title = $row["title"];
            $post->content = $row["content"];
            $post->creationDate = $row["creationDate"];
        }

        $db->close();
        return $post;
    }

    public static function getPostIDs(): string{
        CustomPost::createPostTable();

        $db = new Database("forum.db");
        $db->connect();

        $select = "select * from posts";
        $stmt = $db->pdo->query($select);

        $str = "";

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $str .= $row["id"] . "#";
        }

        $db->close();
        return $str;
    }

    public static function getAllPosts(): array {
        CustomPost::createPostTable();

        $db = new Database("forum.db");
        $db->connect();

        $select = "select * from posts";
        $stmt = $db->pdo->query($select);

        $posts = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post = new CustomPost();
            $post->id = $row["id"];
            $post->author = User::loadDataById($row["authorId"])->name;
            $post->title = $row["title"];
            $post->content = $row["content"];
            $post->creationDate = $row["creationDate"];

            $posts[] = $post;
        }

        $db->close();
        return $posts;
    }

    public static function deletePost($id) {
        CustomPost::createPostTable();

        $db = new Database("forum.db");
        $db->connect();

        $delete = "delete from posts where id = $id";
        $stmt = $db->pdo->prepare($delete);
        $stmt->execute();

        $delete = "delete from comments where postId = $id";
        $stmt = $db->pdo->prepare($delete);
        $stmt->execute();

        User::updatePostCount();

        $db->close();
    }

    public static function createPost($title, $content) {
        $db = new Database("forum.db");
        $db->connect();
        CustomPost::createPostTable();

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

    public static function createPostTable() {
        $db = new Database("forum.db");
        $db->connect();
        $postTable = "create table if not exists posts(
            id integer primary key,
            authorId integer,
            title text,
            content text,
            creationDate text
        )";
        $stmt = $db->pdo->prepare($postTable);
        $stmt->execute();
        $db->close();
    }
}