<h1>Gestion de Producto</h1>

<?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == "Complete") : ?>
    <strong class="save">Su producto fue insertado</strong>

<?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] != "Complete") : ?>
    <strong class="er">Su producto NO fue insertado</strong>

<?php endif; ?>

  <?php  unset($_SESSION['producto']); ?>

  <?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == "complete") : ?>
    <strong class="save">Su producto fue eliminado</strong>

<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] != "complete") : ?>
    <strong class="er">Su producto NO fue eliminado</strong>

<?php endif; ?>

<?php  unset($_SESSION['delete']); ?>


<table>

    <th>NOMBRE</th>
    <th>PRECIO</th>
    <th>STOCK</th>
    <th>OFERTA</th>
    <th>ACCION</th>

    <?php while ($prod = $productos->fetch(PDO::FETCH_OBJ)) : ?>

        <tr>
            <td><?= $prod->nombre ?></td>
            <td><?= $prod->precio ?></td>
            <td><?= $prod->stock ?></td>
            <td><?= $prod->oferta ?></td>
            <td>
                <a href="<?=base_url?>producto_controller/Editar&id=<?=$prod->id?>"class="editar">Editar</a>
                <a href="<?=base_url?>producto_controller/Eliminar&id=<?=$prod->id?> " class="boton">Eliminar</a>
            </td>
        </tr>

    <?php endwhile; ?>
</table>

<a class="buttom" href="<?= base_url ?>producto_controller/Crear">
    Crear producto
</a>