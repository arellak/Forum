<?php


include_once("Database.php");

class User {
    public $id;
    public $name;
    public $email;
    public $password;
    public $registrationDate;
    public $postCount;

    public static $dbName = "forum.db";

    public function __construct() {

    }

    public function __toString() {
        return $this->name . ";" . $this->email . ";" . $this->registrationDate . ";" . $this->postCount;
    }

    public static function createUserTable() {
        $db = new Database(User::$dbName);
        $db->connect();

        $sql = "create table if not exists user(
            id integer primary key autoincrement, 
            name varchar(255) not null,
            password varchar(255) not null,
            email varchar(255) not null,
            registrationDate varchar(255) not null,
            postCount numeric)";
        $stmt = $db->pdo->prepare($sql);
        $stmt->execute();
    }

    public static function create($name, $password, $email){
        User::createUserTable();

        $currentDate = new DateTime();

        $db = new Database(User::$dbName);
        $db->connect();

        $sql = "insert into user(name, password, email, registrationDate, postCount) 
                values (:name, :passwd, :email, :registrationDate, :postCount)";

        $stmt = $db->pdo->prepare($sql);

        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":passwd", password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":registrationDate", $currentDate->format("d.m.Y-H:i:s"));
        $stmt->bindValue(":postCount", 0);

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
        $stmt->bindValue(":password", password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":id", $this->id);

        $stmt->execute();

        $db->close();
    }

    public static function loadDataById($id): User {
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
            $user->registrationDate = $row["registrationDate"];
            $user->postCount = $row["postCount"];
        }

        $db->close();

        return $user;
    }


    public static function loadDataByName($name): User {
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
            $user->registrationDate = $row["registrationDate"];
            $user->postCount = $row["postCount"];
        }

        $db->close();
        if($user->id == null) {
            throw new Exception("Username doesn't exist.");
        }

        return $user;
    }

    public static function getAllUsers(): array {
        $users = [];
        User::createUserTable();

        $db = new Database(User::$dbName);
        $db->connect();

        $sql = "select * from user";
        $stmt = $db->pdo->query($sql);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = new User();
            $user->id = $row["id"];
            $user->name = $row["name"];
            $user->password = $row["password"];
            $user->email = $row["email"];
            $user->registrationDate = $row["registrationDate"];
            $user->postCount = $row["postCount"];

            $users[] = $user;
        }

        $db->close();

        return $users;
    }

}