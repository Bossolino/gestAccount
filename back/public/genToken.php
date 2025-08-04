<?php

function genTokenAdmin(){

    $strResult = '012345678ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqstuvwxyz';
    
    $token = substr(str_shuffle($strResult), 0, 8);
    $t = '9r'.$token;
    return substr(str_shuffle($t), 0);;
}
function genTokenUser(){

    $strResult = '012345678ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqstuvwxyz';

    return substr(str_shuffle($strResult), 0, 8);
}

?>