<?php
    function autocargar($clase){
        include 'controller/'.$clase. '.php'; 
    }
    spl_autoload_register('autocargar');
