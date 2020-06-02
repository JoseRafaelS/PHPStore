<h1>Registrate</h1>

<form action="<?=base_url?>Usuario_controller/Usuario" method="POST">

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre">
    <?php echo isset($_SESSION['error']['nombre'])? $_SESSION['error']['nombre'] : ""; ?>

    <label for="apellido">Apellido</label>
    <input type="text" name="apellido">
    <?php echo isset($_SESSION['error']['apellido'])? $_SESSION['error']['apellido']: ""; ?>

    <label for="email">Email</label>
    <input type="email" name="email">
    <?php echo isset($_SESSION['error']['email'])? $_SESSION['error']['email']: ""; ?>

    <label for="password">Contraseña</label>
    <input type="password" name="password">
    <?php echo isset($_SESSION['error']['password'])? $_SESSION['error']['password']: ""; ?>
    <?php session_unset();?>

    <input type="submit" value="Registrarse">

</form>