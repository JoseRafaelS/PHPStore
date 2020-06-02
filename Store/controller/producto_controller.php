<?php

require_once 'model/producto_model.php';
class Producto_controller
{

    public function index()
    {

        require_once 'view/product/Product_desta.php';
    }
    /* obtiene todos los productos */
    public function gestion()
    {

        Error_admin::is_admin();
        $producto = new Producto_model();
        $productos = $producto->getProductos();

        require_once 'view/producto/producto.php';
    }

    public function crear()
    {
        require_once 'view/producto/formulario.php';
    }

    /* Metodo para guardar producto */

    public function saveProducto()
    {
        Error_admin::is_admin();

        if (isset($_POST) && !empty($_POST)) {

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock  = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $oferta = isset($_POST['oferta']) ? $_POST['oferta'] : false;
            $fecha = date('y-m-d H:i:s');
               
               /* subir archivo */
               $file = $_FILES['imagen'];
               $nombreImagen = $file['name'];
               $type = $file['type'];
   
            if ($nombre && $descripcion && $precio && $stock && $categoria && $oferta) {

                $producto = new Producto_model();
                $producto->setNombre($nombre);
                $producto->setDecripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);
                $producto->setOferta($oferta);
                $producto->setFecha($fecha);

                if($type == "image/jpeg" || $type == "image/jpg" || $type == "image/png" || $type == "image/gif"){

                    if(!is_dir('uploads/imagenes')){
                        mkdir('uploads/imagenes', 0777, true);
                    }
                    move_uploaded_file($file['tmp_name'], 'uploads/'. $nombreImagen);
                    
                    $producto->setImagen($nombreImagen);
                }
                
                $result = $producto->saveProduct();

                if ($result) {

                    $_SESSION['producto'] = "Complete";
                } else {
                    $_SESSION['producto'] = "faile";
                }
            } else {
                $_SESSION['producto'] = "faile";
            }
        } else {

            $_SESSION['producto'] = "faile";
        }

        header("Location:" . base_url . "producto_controller/gestion");
    }

        /* Eliminar Producto */

    public function Eliminar(){
       
       if(isset($_GET['id']) && !empty($_GET)){
            $eliminar = $_GET['id']; 

            $producto =  new Producto_model();
            $producto->setId($eliminar);
            $pro = $producto->eliminar();

            if($pro){
                $_SESSION['delete'] = "complete";
            }else{

                $_SESSION['delete'] = "error";
            }
       }else{
           $_SESSION['delete'] = "error";
       }
       header("location:".base_url. "producto_controller/gestion");
    }

    public function Editar(){

    }
}
