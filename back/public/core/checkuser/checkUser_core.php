<?php 

function checkUser(){
    if (!isset($_COOKIE["user"])) {
        return false;
    } 
    $user = $_COOKIE["user"];
    $user = json_decode($user,true);
    return $user;
}