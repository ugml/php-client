<?php

    // start the session
    // and load the userID
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $userID = $_SESSION['userID'];

    // if there is no userID stored,
    // redirect to the login-page
    if (!$userID) {
        die(header('Location: login.php'));
    }

    // the user is logged in, so we allow
    // script-access within the game
    define('INSIDE', true);

    // load the server-configuration
    require('core/config.php');

    // default value
    $page = 'dashboard';

    // check if a page was requested and if there is
    // a controller to the request
    if (isset($_GET['page']) && file_exists($path['controllers'] . 'admin/' . $_GET['page'] . '.php')) {
        $page = $_GET['page'];

        // do not delete the page-value,
        // because the admin-menu needs it
        // unset($_GET['page']);
    } else {
        // default page
        $_GET['page'] = 'dashboard';
    }


    // include the MVC-files
    require($path['models'] . 'admin/' . $page . '.php');
    require($path['views'] . 'admin/' . $page . '.php');
    require($path['controllers'] . 'admin/' . $page . '.php');

    // load the controller
    switch ($page) {
        case 'dashboard':
            $controller = new C_Dashboard($_GET, $_POST);
            break;
        case 'users':
            $controller = new C_Users($_GET, $_POST);
            break;
    }
    // display the page
    $controller->display();
