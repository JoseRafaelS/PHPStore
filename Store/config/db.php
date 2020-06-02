<?php

    class Conection{
    
        public static function Conectar(){
            try {
                $conexion = new PDO('mysql:host=localhost; dbname=tienda_master','root','');
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conexion->exec("SET CHARACTER SET utf8");
                return $conexion;
            } catch (Exception $e) {

                echo "El error esta en la linea " .$e->getLine(). " y el error es".$e->getMessage();
            } finally{
                $conexion = null;
            } 
        }
    }
