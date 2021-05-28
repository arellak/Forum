<?php

include_once("Database.php");
include_once("User.php");

class Comment {

    public $id;
    public $postId;
    public $authorName;
    public $content;

    public function __toString() {
        return $this->id . ";" . $this->postId . ";" . $this->authorName . ";" . $this->content;
    }

    public static function createCommentTable() {
        $db = new Database("forum.db");
        $db->connect();
        $create = "create table if not exists comments(
            commentId integer primary key,
            postId integer not null,
            authorId integer not null,
            content text not null
        )";

        $stmt = $db->pdo->prepare($create);
        $stmt->execute();



        $db->close();
    }

    public static function create($postId, $authorId, $content) {
        Comment::createCommentTable();

        $db = new Database("forum.db");
        $db->connect();

        $insert = "insert into comments(postId, authorId, content) values(:postId, :authorId, :content)";
        $stmt = $db->pdo->prepare($insert);

        $stmt->bindValue(":postId", $postId);
        $stmt->bindValue(":authorId", $authorId);
        $stmt->bindValue(":content", $content);

        $stmt->execute();

        $db->close();
    }

    public static function getAllComments($postId) {
        Comment::createCommentTable();

        $db = new Database("forum.db");
        $db->connect();
        $select = "select * from comments where postId = $postId";
        $stmt = $db->pdo->query($select);

        $comments = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $comment = new Comment();

            $comment->id = $row["commentId"];
            $comment->postId = $row["postId"];
            $comment->authorName = User::loadDataById($row["authorId"])->name;
            $comment->content = $row["content"];

            $comments[] = $comment;
        }

        $db->close();
        return $comments;
    }

}