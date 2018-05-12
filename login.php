<?php

    /* @var INSIDE boolean constant, to track if the request comes from within the game */
    define('INSIDE', true);


    require_once 'core/config.php';

    // load the server-configuration
    Config::init();

    // register autoloader
    require_once 'core/autoload.php';


    $controller = new C_Login($_GET, $_POST);


    $controller->display();

?>
