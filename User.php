<?php
include_once("Database.php");

class User {
    public $id;
    public $name;
    public $email;
    public $password;

    public static $dbName = "forum.db";

    public function __construct() {

    }

    public static function createUserTable() {
        $db = new Database(User::$dbName);
        $db->connect();

        $sql = "create table if not exists user(
            id integer primary key autoincrement, 
            name text not null,
            password text not null,
            email text not null)";
        $stmt = $db->pdo->prepare($sql);
        $stmt->execute();
    }

    public static function create($name, $password, $email){
        User::createUserTable();

        $db = new Database(User::$dbName);
        $db->connect();

        $sql = "insert into user(name, password, email) values (:name, :passwd, :email)";

        $stmt = $db->pdo->prepare($sql);

        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":passwd", $password);
        $stmt->bindValue(":email", $email);

        $stmt->execute();

        $db->close();
    }

    public function update($name, $password, $email) {
        User::createUserTable();
        $db = new Database(User::$dbName);
        $db->connect();

        $sql = "update :dbName set name = :name, password = :password, email = :email where id = :id";

        $stmt = $db->pdo->prepare($sql);

        $stmt->bindValue(":dbName", User::$dbName);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":password", $password);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":id", $this->id);

        $stmt->execute();

        $db->close();
    }

    public static function loadDataById($id) {
        User::createUserTable();
        $db = new Database(User::$dbName);
        $db->connect();

        $sql = "select * from user where id = $id";
        $stmt = $db->pdo->query($sql);

        $user = new User();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user->id = $row["id"];
            $user->name = $row["name"];
            $user->password = $row["password"];
            $user->email = $row["email"];
        }

        $db->close();

        return $user;
    }

    public static function loadDataByName($name) {
        User::createUserTable();
        $db = new Database(User::$dbName);
        $db->connect();

        $sql = "select * from user where name = '$name'";
        $stmt = $db->pdo->query($sql);

        $user = new User();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user->id = $row["id"];
            $user->name = $row["name"];
            $user->password = $row["password"];
            $user->email = $row["email"];
        }

        $db->close();

        return $user;
    }
}