<?php

    define('INSIDE', true);


    require('core/config.php');

    require($path['controllers'] . '/login.php');
    require($path['models'] . '/login.php');
    require($path['views'] . '/login.php');


    // Controller erstellen
    $controller = new C_Login($_GET, $_POST);

    // Inhalt der Webanwendung ausgeben.
    $controller->display();

?>
