<?php

include_once("Database.php");
include_once("User.php");

class Post {

    public $id;
    public $author;
    public $title;
    public $content;

    public $comments = [];
    public $creationDate;

    public function __construct() {

    }

    public function __toString() {
        return $this->id . ";" . $this->title . ";" . $this->content . ";" .$this->author . ";" . $this->creationDate;
    }

    public static function getPostById($id): Post {
        $post = new Post();
        $db = new Database("forum.db");
        $db->connect();

        $select = "select * from posts where id = $id";
        $stmt = $db->pdo->query($select);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post->id = $row["id"];
            $post->title = $row["title"];
            $post->content = $row["content"];
            $post->author = $row["authorId"];
            $post->creationDate = $row["creationDate"];
        }

        $db->close();
        return $post;
    }

    public static function getPostIDs(): string{
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

    public static function getAllPosts(): string {
        $db = new Database("forum.db");
        $db->connect();

        $select = "select * from posts";
        $stmt = $db->pdo->query($select);

        $str = "";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post = new Post();
            $post->id = $row["id"];
            $post->author = User::loadDataById($row["authorId"])->name;
            $post->title = $row["title"];
            $post->content = $row["content"];
            $post->creationDate = $row["creationDate"];

            $str .= $post . "#";
        }

        $db->close();
        return $str;
    }

}