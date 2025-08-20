<?php
function deleteUser($db, $id){
    $db->where("ID", $id); 
    if($db->delete("users")){ 
        return "Utente cancellato con successo. (core)"; 
    } else { 
        return "ERROR: Utente non cancellato (core): " . $db->getLastError();
    }
    }
