<?php
require_once 'config/db.php';
class Producto_model
{

    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;

    public function __construct()
    {
        $this->db = Conection::Conectar();
    }

    function setId($id)
    {
        $this->id =  $id;
    }


    function setNombre($nombre)
    {
        $this->nombre =  $nombre;
    }

    function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;
    }

    function setDecripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    function setStock($stock)
    {
        $this->stock = $stock;
    }

    function setOferta($oferta)
    {
        $this->oferta = $oferta;
    }

    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    function getCategoria()
    {
        return $this->categoria_id;
    }
    function getNombre()
    {
        return $this->nombre;
    }
    function getDescripcion()
    {
        return $this->descripcion;
    }
    function getPrecio()
    {
        return $this->precio;
    }
    function getStock()
    {
        return $this->stock;
    }
    function getOferta()
    {
        return $this->oferta;
    }
    function getFecha(){
        return $this->fecha;
    }

    function getImagen(){
        return $this->imagen;
    }
    function getId(){
        return $this->id;
    }

    /* obtener todo los productos */
    public function getProductos()
    {

        $sql = "SELECT * FROM productos ORDER BY  id DESC";
        $producto = $this->db->prepare($sql);
        $producto->execute();

        return $producto;
    }

    public function saveProduct()
    {
        $sql = "INSERT INTO PRODUCTOS (categoria_id, nombre,
                                 descripcion, precio, stock, oferta,
                                 fecha,imagen) VALUE (:categoria_id, :nombre, :descripcion, :precio,
                                 :stock,:oferta,:fecha, :imagen)";
        $producto = $this->db->prepare($sql);
        $producto->execute(array(
            ":categoria_id" => "{$this->getCategoria()}", ":nombre" => "{$this->getNombre()}",
            ":descripcion" => "{$this->getDescripcion()}", ":precio" => "{$this->getPrecio()}",
            ":stock" => "{$this->getStock()}", ":oferta" => "{$this->getOferta()}", ":fecha" => "{$this->getFecha()}",
            ":imagen" => "{$this->getImagen()}"
        ));

        $resultado = false;
        if ($producto) {
            $resultado = true;
        }
        $producto->closeCursor();

        return $resultado;
    }

    /* Elimina una fila de la base de datos */

    public function eliminar(){

        $sql = "DELETE FROM PRODUCTOS WHERE ID = :delet";
        $delete = $this->db->prepare($sql);
        $delete->execute(array(":delet" => "{$this->getId()}"));

        $result = false;

        if($delete){
            $result = true;
        }
        $delete->closeCursor();

        return $result;
    }
}
