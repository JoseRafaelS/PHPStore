<?php
session_start();
/* cargando clase con el autolode */
require_once 'autolod.php';
require_once 'config/parametro.php';
require_once 'config/healpers.php';
require_once 'view/layout/header.php';
require_once 'view/layout/sidebar.php';

if (isset($_GET['controller']) && class_exists($_GET['controller'])) {
    $nombre_controlador = $_GET['controller'];
    $controlador = new $nombre_controlador();

    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $action = $_GET['action'];
        $controlador->$action();
    } else {
        show_error();
    }
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $nombre_controlador =  controller_default;
    $controlador = new $nombre_controlador;
    $action = action_default;
    $controlador->$action();
} else {
    show_error();
}

require_once 'view/layout/footer.php';
