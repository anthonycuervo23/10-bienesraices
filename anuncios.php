<?php 

    require 'includes/funciones.php';

    incluirTemplate('header');
?>

    <section class="seccion contendor">
        <h2>Casas y Pisos en Venta</h2>

        <?php 
            $limite = 6; //mostrar un maximo de 3 propiedades
            include './includes/templates/anuncios.php' 
        ?>

    </section>



    <?php incluirTemplate('footer'); ?>