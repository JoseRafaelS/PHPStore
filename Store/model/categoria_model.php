<?php
    require_once 'config/db.php';
    class Categoria_model{
        private $id;
        private $nombre;
        private $db;

        public function __construct()
        {
            $this->db = Conection::Conectar();
        }

        function setId($id){
            $this->id = $id;
        }
        function setNombre($nombre){
            $this->nombre =  $nombre;
        }

        function getId(){
            return $this->id;
        }
        function getNombre(){

            return $this->nombre;
        }

        public function getCategoria(){

            $sql = "SELECT * FROM categorias ORDER BY id DESC";
            $categorias = $this->db->prepare($sql);
            $categorias->execute();

            return $categorias;
        }

        public function save_categoria(){

           $sql = "INSERT INTO categorias (nombre) VALUE (:nombre)";
           $insert = $this->db->prepare($sql);
           $insert->execute(array(":nombre"=>"{$this->getNombre()}"));  
        }

    }