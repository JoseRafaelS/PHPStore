<?php
    
    /* constante definida para limpiar las URL */
    define("base_url", "http://localhost/tienda/");
    define("controller_default","Producto_controller");
    define("action_default","index");
   
    /* Esta funcion se muestra en el index para cuando el usuario entra a una URl incorrecta */
    function show_error(){

        $error = new Error_controller();
        $error->index();
    }

    