<?php


function createCookie($username): bool {
    return setcookie("accountName", $username, time() + (86400*30), "/");
}

function deleteCookie(): bool {
    return setcookie("accountName", "", time() - 1000, "/");
}