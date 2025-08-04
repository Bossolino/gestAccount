<?php

function createUser($db, $NOME, $EMAIL, $ETA){
    $data = array(
        'NOME' => $NOME,
        'EMAIL' => $EMAIL,
        'ETA' => $ETA
    );


    if ($db->insert('users', $data)){
        return "user was created." . var_dump($data);
    }else{
        return "insert failed: " . $db->getLastError() . var_dump($data);
    }
}