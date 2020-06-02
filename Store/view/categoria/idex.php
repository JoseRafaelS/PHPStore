<h1>Gestionar categoria</h1>

<table >
    <th>ID</th>
    <th>NOMBRE</th>
    
    <?php while($cat = $categoria->fetch(PDO::FETCH_OBJ) ): ?>
        <tr>
            <td><?=$cat->id?></td>
            <td><?=$cat->nombre?></td>
        </tr>
    <?php endwhile; ?>
</table>


<a class="buttom" href="<?= base_url?>Categoria_controller/crear">
    Crear categoria
</a>









