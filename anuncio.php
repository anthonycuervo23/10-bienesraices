<?php 

    require 'includes/funciones.php';

    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img src="build/img/destacada.jpg" alt="anuncio" loading="lazy">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p>4</p>
                </li>
            </ul>

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