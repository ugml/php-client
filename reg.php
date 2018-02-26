<?php


    define('INSIDE', true);


    // register autoloader
    require_once 'core/autoload.php';

    require('core/config.php');



    $controller = new C_Register($_GET, $_POST);


    $controller->display();

?>
