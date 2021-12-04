<?php 

    require 'includes/funciones.php';

    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guia para la decoracion de tu hogar</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img src="build/img/destacada2.jpg" alt="imagen entrada blog" loading="lazy">
        </picture>

        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span> </p>

        <div class="resumen-propiedad">

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi amet, pariatur architecto, 
                perspiciatis fugit labore recusandae similique impedit ipsam repellendus, odio quos ipsum 
                sequi ratione quasi vitae consequatur modi dolorem. Lorem ipsum dolor sit amet, 
                consectetur adipisicing elit. Id error ratione sed deserunt itaque magni minus sequi maiores, 
                ex voluptatibus obcaecati corporis debitis dicta suscipit eaque libero rem dolor 
                facilis.</p>
                
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil dignissimos unde in voluptatum 
                veniam cupiditate quas reprehenderit veritatis, perspiciatis aut, nobis eaque voluptatem 
                pariatur? Quod, repellendus. Velit, veniam nisi! Adipisci!</p>
        </div>
    </main>

    <?php incluirTemplate('footer'); ?>