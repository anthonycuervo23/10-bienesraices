<?php

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image; 

require '../../includes/app.php';

    estaAutenticado();
    
    //obtenemos el id de la propiedad a actualizar desde el url
    $id = $_GET['id'];
    //Validamos que sea un numero
    $id = filter_var($id, FILTER_VALIDATE_INT);

    //si mandan un id incorrecto redireccionamos al inicio
    if(!$id) {
        header('Location: /admin');
    }


    //Consultar en DB la propiedad a actualizar
    $propiedad = Propiedad::getByID($id);


    //Consultar DB para obtener los vendedores
    $consultaVendedores = "SELECT * FROM vendedores";
    $resultadoVendedores = mysqli_query($db, $consultaVendedores);

    //Array con mensajes de errores
    $errores = Propiedad::getErrores();

    // Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Asignar los atributos
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);

        // Validacion de formulario
        $errores = $propiedad->validar();

        /** SUBIDA DE ARCHIVOS */

        //Generar un nombre unico al archivo
        $nombreImagen = md5( uniqid(rand(), true) ) . '.jpg';

        //Setear la imagen
        // Realiza un resize a la imagen con intervention
        if($_FILES['propiedad']['tmp_name']['imagen']){
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            $propiedad->setImagen($nombreImagen);
        }

        // Revisar que el array de errores este vacio
        if (empty($errores)){

            //Almacenar la imagen
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }

            // guardar registro en base de datos
            $propiedad->guardarDB();
        }
        
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error) { ?>
            
            <div class="alerta error">
                <?php echo $error; ?>
            </div>    
           
       <?php } ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">

            <?php include '../../includes/templates/formulario.php' ?>

            <input type="submit" value="Actualizar Propiedad" class="boton-verde">
        </form>
    </main>

    <?php incluirTemplate('footer'); ?>