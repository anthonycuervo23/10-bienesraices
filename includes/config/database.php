<?php

function conectarDB() {

    $db = new mysqli('localhost', 'root', '', 'bienesraices_crud');

    if(!$db){
        echo 'Error conectando DB';
        exit;
    }

    return $db;

}