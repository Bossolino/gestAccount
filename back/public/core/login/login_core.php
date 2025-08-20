<?php

require_once __DIR__ . '/../../genToken.php';
function login($db, $email, $password) {
    $db->where("EMAIL", $email);
    $utente = $db->getOne("users");

    if (!$utente || $utente['PASSWORD'] !== $password ) {
        return ['error' => 'Email o assword errata'];
    }

    unset($utente['PASSWORD']);
    setcookie("token", $utente["token"], 0,'/');
    if ($utente['ADMIN'] == 1) {
        $utente['token'] = genTokenAdmin();
    } else {
        $utente['token'] = genTokenUser();
    }
    return $utente;
}
