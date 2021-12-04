<?php

function conectarDB() {

    $db = mysqli_connect('localhost', 'root', '', 'bienesraices_crud');

    if(!$db){
        echo 'Error conectando DB';
        exit;
    }

    return $db;

}