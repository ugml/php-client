<?php

    if (DEBUG) {
        /* @var RENDERING_STARTTIME time of start for the page-rendering */
        define("RENDERING_STARTTIME", microtime(true));
    }

    // start the session
    // and load the userID
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // if there is no userID stored,
    // redirect to the login-page
    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
    } else {
        header('Location: login.php');
        die();
    }

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        // last request was more than 30 minutes ago
        session_unset();     // unset $_SESSION variable for the run-time
        session_destroy();   // destroy session data in storage
    }

    // ---- user is logged in at this point ----

    // the user is logged in, so we allow
    // script-access within the game

    /* @var INSIDE boolean constant, to track if the request comes from within the game */
    define('INSIDE', true);

    // update last activity time stamp
    $_SESSION['LAST_ACTIVITY'] = time();

    // register autoloader
    require_once 'core/autoload.php';

    // initialize static objects
    Config::init();
    D_Units::init();


    // load the database-class
    $dbConnection = new Database();

    // load the userdata
    $data = new Loader($userID);

    // update the planet (ressources etc.)
    $data->getPlanet()->update($data->getBuildingData(), $data->getTechData(), $data->getFleetData());

    // default value
    $page = 'overview';

    // check if a page was requested and if there is
    // a controller to the request
    if (isset($_GET['page']) && file_exists(Config::$pathConfig['controllers'] . $_GET['page'] . '.php')) {
        $page = $_GET['page'];

        // delete the element, because the controller
        // does not need the page-value
        unset($_GET['page']);
    } else {
        // file does not exist -> redirect to overview
        if (isset($_GET['page']) && !file_exists(Config::$pathConfig['controllers'] . $_GET['page'] . '.php')) {
            $page = 'overview';
        }
    }


    // load the controller
    $className = 'C_' . ucfirst($page);

    $controller = new $className($_GET, $_POST);



    $lang['admin_link'] = ($userID == 1) ? '<li><a href="admin.php" style="color:lime;"><i class="fa fa-user-circle-o"></i> Admin</a></li>' : 'x';

    // get coords for galaxy menu-link
    $lang["g"] = $data->getPlanet()->getGalaxy();
    $lang["s"] = $data->getPlanet()->getSystem();

    $lang["ugamela_version"] = Config::$gameConfig['ugamela_version'];
    $lang["game_name"] = Config::$gameConfig['game_name'];

    // display the page
    $controller->display();
