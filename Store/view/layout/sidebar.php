<aside id="aside">
    <div id="login" class="block_aside">

        <?php if (!isset($_SESSION['login'])) :  ?>
            <h3>Entrada web</h3>
            <form action="<?= base_url ?>Usuario_controller/loging" method="POST">
                <label for="email">Name imail</label>
                <input type="text" name="email">
                <label for="contra">contraseña</label>
                <input type="text" name="contra">

                <input type="submit" value="Enviar">
            </form>
 
        <?php else :  ?>
            <h3><?= $_SESSION['login']->nombre ?> <?= $_SESSION['login']->apellido ?></h3>
        <?php endif; ?>

        <?php if(isset($_SESSION['error_login'])){
            echo $_SESSION['error_login'];
            session_destroy();
        } ?>

        <ul>
            <?php if (isset($_SESSION['admin'])) : ?>
                <li><a href="<?=base_url?>Categoria_controller/index">Gestionar categoria</a></li>
                <li><a href="<?=base_url?>producto_controller/gestion">Gestionar prducto</a></li>
                <li><a href="">Gestionar Pedidos</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['login'])) : ?>
                <li><a href="">Mis pedidos</a> </li>
                <li><a href="<?= base_url ?>Usuario_controller/Logaut">Cerrar Sesion</a></li>
            <?php else: ?>
                <li><a href="<?= base_url?>Usuario_controller/Registro">Registrarse</a></li>
            <?php endif; ?>
        </ul>
    </div>
</aside>
</div>
<!-- contenido central -->
<div id="central">