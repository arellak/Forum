<?php


function createCookie($username) {
    $cookieValue = "penis";
    // return setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/");
    return setcookie($username, $cookieValue, time() + 100, "/");
}

function isSessionExpired() {

}

createCookie("anna");