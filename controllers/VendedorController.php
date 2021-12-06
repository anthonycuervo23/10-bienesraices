<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Vendedor;

class VendedorController {

        public static function crear(Router $router) {

            $errores = Vendedor::getErrores();
            $vendedor = new Vendedor;

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                //Crear una nuevo instancia
                $vendedor = new Vendedor($_POST['vendedor']);
        
                // Validar que no haya campos vacios
                $errores = $vendedor->validar();
        
                if(empty($errores)) {
                    $vendedor->guardarDB();
                }
            }


            $router->render('vendedores/crear', [
                'errores' => $errores,
                'vendedor' => $vendedor,

            ]);
        }

        public static function actualizar(Router $router) {

            $id = validarORedireccionar('/admin');

            $vendedor = Vendedor::getByID($id);


            $errores = Vendedor::getErrores();

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                //sincronizar el obj en memoria con los datos del formulario
                $args = $_POST['vendedor'];
                $vendedor->sincronizar($args);
        
                // Validar
                $errores = $vendedor->validar();
        
                if(empty($errores)){
                    $vendedor->guardarDB();
                }              
            }

            $router->render('vendedores/actualizar', [
                'errores' => $errores,
                'vendedor' => $vendedor,

            ]);
        }

        public static function eliminar() {
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);
        
                if($id) {
                    $tipo = $_POST['tipo'];
        
                    if(validarTipoContenido($tipo)){
                        $vendedor = Vendedor::getByID($id);
                        $vendedor->eliminar();
                    }
                }
            }
        }
    }