<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $controller) {
        $this->rutasGET[$url] = $controller;
    }

    public function post($url, $controller){
        $this->rutasPOST[$url] = $controller;
    }

    public function comprobarRutas() {

        session_start();

        $auth = $_SESSION['login'] ?? false;

        //Arreglo de rutas protegidas
        $rutas_protegidas = [
            '/admin',
            '/propiedades/crear',
            '/propiedades/actualizar',
            '/propiedades/eliminar',
            '/vendedores/crear',
            '/vendedores/actualizar',
            '/vendedores/eliminar',
        ];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo == 'GET'){
            $controller = $this->rutasGET[$urlActual] ?? null;
        } else {
            $controller = $this->rutasPOST[$urlActual] ?? null;
        }

        // Proteger las rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth){
                header('Location: /');
        }

        if ($controller) {
            // la URL existe y hay un controlador asociado
            call_user_func($controller, $this);
        } else {
            echo 'NOT FOUND';
        }
        
    }

    // Muestra una vista
    public function render($view, $datos = []) {

        foreach ($datos as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include __DIR__ . '/views/' . $view . '.php';

        $contenido = ob_get_clean(); // limpiar el Buffer

        include __DIR__ . '/views/layout.php';
    }
}