<?php

include("Database.php");
include("User.php");
include("Session.php");

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
        $user = User::loadDataByName($username);

        if(password_verify($password, $user->password)) {
            if(isset($_COOKIE[$username])) {
                echo "nice.";
            } else {
                createCookie($username);
                echo "penis";
            }
        } else {
            throw new Exception("Password is wrong.");
        }
    } catch(Exception $e) {
        echo "Couldn't login: " . $e->getMessage();
    } finally {
        $db->close();
    }
}
