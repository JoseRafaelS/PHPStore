<?php

class Error_admin
{
    /* Este metodo comprueva si existe el usuario admin */
    public static function is_admin()
    {
        if (isset($_SESSION['admin'])) {
            return true;
        } else {
            header("location:". base_url);
        }
    }
        /* obtiene todas las categoria */
    public static function showCategoria(){

        require_once 'model/categoria_model.php';

        $categorias = new Categoria_model();
        $categoria = $categorias->getCategoria();
        return $categoria;
    }
}
