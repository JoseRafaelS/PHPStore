<h1>Crear Categoria</h1>

<form action="<?=base_url?>Categoria_controller/save" method="POST">

<label for="nombre">Nombre</label>
<input type="text" name="nombre"/>

<input type="submit" value="Guardar">

</form>

<?php echo isset($_SESSION['error_categoria']) ? $_SESSION['error_categoria'] : " "; ?>
<?php unset($_SESSION['error_categoria']) ?> 