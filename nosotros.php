<?php 

    require 'includes/app.php';

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img src="build/img/nosotros.jpg" alt="nosotros" loading="lazy">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia.
                </blockquote>

                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt cum possimus 
                    optio voluptates, nesciunt reprehenderit aspernatur esse consectetur repellat nisi 
                    harum officia eos saepe ullam aliquam, velit officiis nihil obcaecati?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi est aperiam consectetur 
                    vitae aliquid nulla facere similique cum sint delectus rem eos laudantium vero, ullam, 
                    libero exercitationem veniam, magni reprehenderit.</p>

                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste maiores exercitationem 
                        quos consequuntur ab temporibus quis minima iure hic vitae ullam doloribus debitis 
                        eligendi eveniet, laboriosam repudiandae numquam illum saepe.</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Mas Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit, Laudantium.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit, Laudantium.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit, Laudantium.</p>
            </div>
        </div>
    </section>

    <?php incluirTemplate('footer'); ?>