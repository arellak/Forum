<?php

include_once("Database.php");
include_once("User.php");
include_once("Session.php");

function register($username, $password, $email) {
    try {
        User::create($username, $password, $email);
        echo "Success";
    } catch(Exception $e) {
        echo "Couldn't create User: " . $e->getMessage();
    }
}

function login($username, $password) {
    $db = new Database("forum.db");
    $db->connect();

    try {
        if($username == "" || $password == "") {
            throw new Exception("Username or password is empty.");
        }

        $user = User::loadDataByName($username);
        if(password_verify($password, $user->password)) {
            session_start();
            saveIDinDb(session_id(), $username);
            header("location:index.php");
        } else {
            throw new Exception("Password is wrong.");
        }
    } catch(Exception $e) {
        echo "Couldn't login: " . $e->getMessage();
    } finally {
        $db->close();
    }
}

function logout() {
    session_start();

    deleteTempID(session_id());

    $_SESSION = array();

    if(ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();
}

function saveIDinDb($uniqueId, $username) {
    $userId = "";
    try {
        $userId = User::loadDataByName($username)->id;
    } catch (Exception $e) {
        echo "Couldn't load User: " . $e->getMessage();
    }

    $db = new Database("forum.db");
    $db->connect();

    $loginIdTable = "create table if not exists userIDs(
        uuid unique not null,
        userId int not null
    );";

    $stmt = $db->pdo->prepare($loginIdTable);
    $stmt->execute();

    $insert = "insert into userIDs(uuid, userId) values(:uuid, :userId)";
    $stmt = $db->pdo->prepare($insert);
    $stmt->bindValue(":uuid", $uniqueId);
    $stmt->bindValue(":userId", $userId);
    $stmt->execute();
}

function deleteTempID($id) {
    $db = new Database("forum.db");
    $db->connect();

    $delete = "delete from userIDs where uuid = :id";
    $stmt = $db->pdo->prepare($delete);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
}

function getUserIdBySessionID($sessionId) {
    $db = new Database("forum.db");
    $db->connect();

    $select = "select userId from userIDs where uuid = '$sessionId'";

    $stmt = $db->pdo->query($select);

    $userId = "";

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $userId = $row["userId"];
    }

    if($userId == "") {
        throw new Exception("");
    }

    return $userId;
}