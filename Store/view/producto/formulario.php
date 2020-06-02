<h1>Crear producto</h1>

<form action="<?= base_url ?>producto_controller/saveProducto" method="POST" enctype="multipart/form-data">

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" />

    <label for="descripcion">Descripcion</label>
    <textarea name="descripcion" cols="23" rows="2"></textarea>

    <label for="precio">Precio</label>
    <input type="text" name="precio" />

    <label for="stock">Stock</label>
    <input type="text" name="stock" />

    <label for="oferta">Oferta</label>
    <input type="text" name="oferta" />

    <!-- Lista la categoria  que esta guardada en la base de datos -->
    <label for="categoria">Categoria</label>
    <?php $Obte = Error_admin::showCategoria(); ?>

    <select name="categoria">
        <?php while ($ob = $Obte->fetch(PDO::FETCH_OBJ)) : ?>
            <option value="<?= $ob->id ?>">
                <?= $ob->nombre ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label for="imagen">Imagen</label>
    <input type="file" name="imagen" />

    <input type="submit" value="Guardar">

</form>