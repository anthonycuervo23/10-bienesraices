<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="titulo" placeholder="Titulo Prodiedad" value="<?php echo sanitizar( $propiedad->titulo ); ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" placeholder="Precio Prodiedad" value="<?php echo sanitizar( $propiedad->precio ); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

    <label for="descripcion">Descripcion:</label>
    <textarea id="descripcion" name="descripcion"><?php echo sanitizar( $propiedad->descripcion ); ?></textarea>
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
            value="<?php echo sanitizar( $propiedad->habitaciones ); ?>">

    <label for="wc">Baños:</label>
    <input type="number"
            id="wc" 
            name="wc" 
            placeholder="Ej: 3" 
            min="1" 
            max="9" 
            value="<?php echo sanitizar( $propiedad->wc ); ?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitizar( $propiedad->estacionamiento ); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>

</fieldset>