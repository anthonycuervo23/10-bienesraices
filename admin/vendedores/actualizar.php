<?php 
    require '../../includes/app.php';


    use App\Vendedor;

    estaAutenticado();

    // Validar que sea un ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /admin');
    }

    // Obtener el arreglo del vendedor de DB
    $vendedor = Vendedor::getByID($id);

    //Array con mensajes de errores
    $errores = Vendedor::getErrores();

    // Ejecutar el codigo despues de que el usuario envia el formulario
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

    incluirTemplate('header');
?>

<main class="contenedor seccion">
        <h1>Actualizar Vendedor</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error) { ?>
            
            <div class="alerta error">
                <?php echo $error; ?>
            </div>    
           
       <?php } ?>

        <form class="formulario" method="POST">
            <?php include '../../includes/templates/formulario_vendedores.php'  ?>
            

            <input type="submit" value="Guardar Cambios" class="boton-verde">
        </form>
    </main>

    <?php incluirTemplate('footer'); ?>