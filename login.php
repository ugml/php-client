<?php

    /* @var INSIDE boolean constant, to track if the request comes from within the game */
    define('INSIDE', true);


    // register autoloader
    require_once 'core/autoload.php';

    require('core/config.php');



    $controller = new C_Login($_GET, $_POST);


    $controller->display();

?>
