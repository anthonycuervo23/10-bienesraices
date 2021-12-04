<?php 
    //obtenemos el id de la propiedad a actualizar desde el url
    $id = $_GET['id'];
    //Validamos que sea un numero
    $id = filter_var($id, FILTER_VALIDATE_INT);

    //si mandan un id incorrecto redireccionamos al inicio
    if(!$id) {
        header('Location: /admin');
    }

    //Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    //Consultar en DB la propiedad a actualizar
    $consultaPropiedad = "SELECT * FROM propiedades WHERE id = $id";
    $resultadoPropiedad = mysqli_query($db, $consultaPropiedad);
    $propiedad = mysqli_fetch_assoc($resultadoPropiedad);


    //Consultar DB para obtener los vendedores
    $consultaVendedores = "SELECT * FROM vendedores";
    $resultadoVendedores = mysqli_query($db, $consultaVendedores);

    //Array con mensajes de errores
    $errores = [];

    // inicializamos las variables globales
    $titulo = $propiedad['titulo'] ?? '';
    $precio = $propiedad['precio'] ?? '';
    $descripcion = $propiedad['descripcion'] ?? '';
    $habitaciones = $propiedad['habitaciones'] ?? '';
    $wc =  $propiedad['wc'] ?? '';
    $estacionamiento = $propiedad['estacionamiento'] ?? '';
    $vendedorId = $propiedad['vendedorId'] ?? '';
    $imagenPropiedad = $propiedad['imagen'];

    // Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // echo '<pre>';
        // var_dump($_POST);
        // echo '</pre>';

        // echo '<pre>';
        //     var_dump($_FILES);
        // echo '</pre>';

        $titulo = mysqli_real_escape_string( $db, $_POST['titulo']);
        $precio = mysqli_real_escape_string( $db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string( $db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento']);
        $vendedorId = mysqli_real_escape_string( $db, $_POST['vendedor']);
        $creado = date('Y/m/d');

        // Asignar files hacia una variable
        $imagen = $_FILES['imagen'];



        if(!$titulo){
            $errores[] = 'Debes añadir un titulo';
        }
        if(!$precio){
            $errores[] = 'Debes añadir un precio';
        }
        if(strlen($descripcion) < 50){
            $errores[] = 'La descripcion es obligatoria y debe tener al menos 50 caracteres';
        }
        if(!$habitaciones){
            $errores[] = 'Debes añadir el numero de habitaciones';
        }
        if(!$wc){
            $errores[] = 'Debes añadir el numero de baños';
        }
        if(!$estacionamiento){
            $errores[] = 'Debes añadir el numero de estacionamientos';
        }
        if(!$vendedorId){
            $errores[] = 'Debes elegir el vendedor';
        }
        // Validar imagen por tamaño  (2Mb max)
        $medida = 1000 * 2000;
        if($imagen['size'] > $medida){
            $errores[] = "La imagen es muy pesada, peso maximo: 100Kb";
        }
        
        //  echo '<pre>';
        //  var_dump($errores);
        //  echo '</pre>';
        // Revisar que el array de errores este vacio
        if (empty($errores)){
            //Subida de imagenes

            //Crear carpeta
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            $nombreImagen = '';

            if($imagen['name']){
                //eliminar la imagen previa del servidor
                unlink($carpetaImagenes . $propiedad['imagen']);

                //Generar un nombre unico al archivo
                $nombreImagen = md5( uniqid(rand(), true) ) . '.jpg';

                // subir imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            } else {
                $nombreImagen = $propiedad['imagen'];
            }
            

            // Insertar en la base de datos
            $query = "UPDATE  propiedades SET titulo = '$titulo', precio = '$precio', imagen = '$nombreImagen', descripcion = '$descripcion', habitaciones = $habitaciones, wc = $wc, estacionamiento = $estacionamiento, vendedorId = $vendedorId WHERE id = $id";

            // echo $query;

            $resultado = mysqli_query($db, $query);

            if($resultado){
                // Redericcionar al usuario

                header('Location: /admin?resultado=2');
            } 

        }
        
    }

    require '../../includes/funciones.php';

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

            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Prodiedad" value="<?php echo $titulo ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Prodiedad" value="<?php echo $precio ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="/imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small">

                <label for="descripcion">Descripcion:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" 
                       id="habitaciones" 
                       name="habitaciones" 
                       placeholder="Ej: 3" 
                       min="1" 
                       max="9" 
                       value="<?php echo $habitaciones ?>">

                <label for="wc">Baños:</label>
                <input type="number"
                       id="wc" 
                       name="wc" 
                       placeholder="Ej: 3" 
                       min="1" 
                       max="9" 
                       value="<?php echo $wc ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="" disabled selected>-- Seleccione --</option>
                    
                    <?php while($vendedor = mysqli_fetch_assoc($resultadoVendedores)){ ?>
                        <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : '' ?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . ' ' . $vendedor['apellido']; ?></option>
                   <?php } ?>
                </select>
            </fieldset>

            <input type="submit" value="Actualizar Propiedad" class="boton-verde">
        </form>
    </main>

    <?php incluirTemplate('footer'); ?>