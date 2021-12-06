<?php 
    require '../../includes/app.php';


    use App\Vendedor;

    estaAutenticado();

    $vendedor = new Vendedor;

    //Array con mensajes de errores
    $errores = Vendedor::getErrores();

    // Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Crear una nuevo instancia
        $vendedor = new Vendedor($_POST['vendedor']);

        // Validar que no haya campos vacios
        $errores = $vendedor->validar();

        if(empty($errores)) {
            $vendedor->guardarDB();
        }
    }

    incluirTemplate('header');
?>

<main class="contenedor seccion">
        <h1>Registrar Vendedor</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error) { ?>
            
            <div class="alerta error">
                <?php echo $error; ?>
            </div>    
           
       <?php } ?>

        <form class="formulario" method="POST" action="/admin/vendedores/crear.php">
            <?php include '../../includes/templates/formulario_vendedores.php'  ?>
            

            <input type="submit" value="Registrar Vendedor" class="boton-verde">
        </form>
    </main>

    <?php incluirTemplate('footer'); ?>