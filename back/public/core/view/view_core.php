<?php 
function getUsers($db){
    $users = $db->get("users", null, '*');
    return $users;
}