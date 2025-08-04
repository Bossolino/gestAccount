<?php 

function logout() {
    if (isset($_COOKIE["user"])) {
        setcookie("user", "", time() - 3600, "/");
    } 
    return true;
}