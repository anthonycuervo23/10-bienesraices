<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function incluirTemplate( string $nombre, $inicio = false) {
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() {
    session_start();

    if(!$_SESSION['login']){
        header('Location: /');
    }
}

function debugger($debug){
    echo '<pre>';
        var_dump($debug);
    echo '</pre>';
    exit;
}

//Escapar / sanitizar el  HTML
function sanitizar($html) : string {
    $sanitizar = htmlspecialchars($html);
    return $sanitizar;
}

// Validar tipo de contenido
function validarTipoContenido($tipo) {
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

// muestra los mensajes
function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch ($codigo) {
        case 1: 
            $mensaje = 'Registro Creado Correctamente';
            break;
        case 2: 
            $mensaje = 'Registro Actualizado Correctamente';
            break;
        case 3: 
            $mensaje = 'Registro Creado Correctamente';
            break;
        
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}