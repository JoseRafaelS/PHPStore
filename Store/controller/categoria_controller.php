<?php
require_once 'model/categoria_model.php';
class Categoria_controller
{
    /* metodo para mostrar todas la categorias */
    public function Index()
    {
        Error_admin::is_admin();
        $categorias = new Categoria_model();
        $categoria = $categorias->getCategoria();

        require_once 'view/categoria/idex.php';
    }
    /* crea categoria */
    public function crear()
    {
        Error_admin::is_admin();
        require_once 'view/categoria/crear.php';
    }

    /* Guarda categoria */

    public function save()
    {
       Error_admin::is_admin();

        if (isset($_POST) && !empty($_POST)) {

            $categoria = $_POST['nombre'];
            
            if (!empty($categoria) && !is_numeric($categoria) && !preg_match('/[0-9]/', $categoria)) {

                $insert = new Categoria_model();
                $insert->setNombre($categoria);
                $insert->save_categoria();

                header("location:". base_url . "categoria_controller/index");
            } else {

                $_SESSION['error_categoria'] = "<p class='er'>Su categoria es incorrecta</p>";
                header("location:". base_url ."categoria_controller/crear");
            }
        } else {

            header("location:" . base_url);
        }
    }
}
