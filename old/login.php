<?php 
    //conexion DB
    require 'includes/app.php';
    $db = conectarDB();

    $errores = [];

    //Autenticar el usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if (!$email){
            $errores[] = 'El email no es valido';
        }
        if (!$password){
            $errores[] = 'Contraseña no valida';
        }

        if(empty($errores)){
            //Revisar si usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '$email'";
            $resultado = mysqli_query($db, $query);

            if ($resultado->num_rows){
                //Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                //Verificar si el password es correcto o no
                $auth = password_verify($password, $usuario['password']);

                if($auth){
                    //usuario esta autenticado
                    session_start();

                    // llenar el arreglo de la sesion
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');
                    
                } else {
                    $errores[] = 'Contraseña incorrecta.';
                }

            } else {
                $errores[] = 'El usuario no existe';
            }
        }
    }

    // Incluye el header
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>

        <?php foreach ($errores as $error) { ?>
            
            <div class="alerta error"><?php echo $error; ?></div>

        <?php } ?>

        <form method="POST" class="formulario" novalidate>
        <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password" required>
            </fieldset>

            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </form>
    </main>

    <?php incluirTemplate('footer'); ?>