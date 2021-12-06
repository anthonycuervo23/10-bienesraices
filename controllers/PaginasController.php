<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

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

        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $respuesta = $_POST['contacto'];

            // Crear instancia de PHPMailer
            $mail = new PHPMailer();

            // Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'aaba0e4906801f';
            $mail->Password = 'f1df898f753363';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            // Configurar el contenido del mail
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('jcuervo2390@gmail.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre:  ' . $respuesta['nombre'] . '</p>';
            //Enviar de forma condicional el campo de telefono o email
            if($respuesta['contacto'] == 'telefono'){
                $contenido .= '<p>El cliente desea ser contactado por telefono</p>';
                $contenido .= '<p>Telefono:  ' . $respuesta['telefono'] . '</p>';
                $contenido .= '<p> dia para contactar:  ' . $respuesta['fecha'] . '</p>';
                $contenido .= '<p> hora para contactar:  ' . $respuesta['hora'] . '</p>';

            } else {
                $contenido .= '<p>El cliente desea ser contactado via email</p>';
                $contenido .= '<p>Email:  ' . $respuesta['email'] . '</p>';
            }
            $contenido .= '<p>Mensaje:  ' . $respuesta['mensaje'] . '</p>';
            $contenido .= '<p> vende o compra:  ' . $respuesta['tipo'] . '</p>';
            $contenido .= '<p> Precio o Presupuesto:  $' . $respuesta['precio'] . '</p>';
            
            $contenido .= '</html>';
            $mail->Body = $contenido;

            //Enviar el email
            if($mail->send()) {
                $mensaje = 'Mensaje enviado correctamente';
            } else {
                $mensaje = 'Algo salio mal al enviar el mensaje';
            }

        }
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje,
        ]);
    }

}