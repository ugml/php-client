<?php

define('INSIDE', true);


require('core/config.php');

require($path['controllers'].'/login.controller.php');
require($path['models'].'/login.model.php');
require($path['views'].'/login.view.php');


// Controller erstellen
$controller = new C_Login($_GET, $_POST);

// Inhalt der Webanwendung ausgeben.
$controller->display();

?>
