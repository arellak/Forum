<?php


class Post {

    public $id;
    public $author;
    public $title;
    public $content;

    public $comments = [];
    public $creationDate;

    public function __construct() {

    }
}