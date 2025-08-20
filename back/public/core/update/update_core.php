<?php 
function updateUser($db, $id, $nome, $email, $eta){
    $data = [
        'NOME' => $nome,
        'EMAIL' => $email,
        'ETA' => $eta
    ];
    $db->where('ID', $id);
    if ($db->update('users', $data)) {
        return "L'utente con ID={$id} è stato aggiornato con successo.";
    } else {
        return "Errore: " . $db->getLastError();
    }
}
