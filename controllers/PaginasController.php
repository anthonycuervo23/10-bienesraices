<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;

class PaginasController {

    public static function index(Router $router) {
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index' ,[
            'propiedades' => $propiedades,
            'inicio' => $inicio,
        ]);
    }

    public static function nosotros(Router $router) {
        $router->render('paginas/nosotros', []);
    }

    public static function propiedades(Router $router) {
        $limite = 6;
        $propiedades = Propiedad::getAll();
        $router->render('paginas/propiedades', [
            'limite' => $limite,
            'propiedades' => $propiedades,
        ]);
    }

    public static function propiedad(Router $router) {

        $id = validarORedireccionar('/');
        $propiedad = Propiedad::getByID($id);
        $router->render('/paginas/propiedad', [
            'propiedad' => $propiedad,
        ]);   
    }

    public static function blog(Router $router) {
        $router->render('paginas/blog', []);
    }

    public static function entrada(Router $router) {
        $router->render('paginas/entrada', []);
    }

    public static function contacto(Router $router) {

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            debugger($_POST);
        }
        $router->render('paginas/contacto', []);
    }

}