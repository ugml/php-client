<?php

    // start the session
    // and load the userID
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // if there is no userID stored,
    // redirect to the login-page
    if(isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
    } else {
        header('Location: login.php');
//        die(header('Location: login.php'));
    }

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        // last request was more than 30 minutes ago
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
    }

    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

    // the user is logged in, so we allow
    // script-access within the game
    define('INSIDE', true);
    

    // load the server-configuration
    require_once('core/config.php');
    
    // load the database-class
    require_once($path['classes'] . 'db.class.php');
    $db = new Database();
    

    // load the userdata
    $data = loadUserData($userID);

    // update the planet (ressources etc.)
    $data->getPlanet()->updatePlanet();

    // default value
    $page = 'overview';

    // check if a page was requested and if there is
    // a controller to the request
    if(isset($_GET['page']) && file_exists($path['controllers'].$_GET['page'].'.controller.php')) {
        $page = $_GET['page'];

        // delete the element, because the controller
        // does not need the page-value
        unset($_GET['page']);
    } else {
        if(isset($_GET['page']) && !file_exists($path['controllers'].$_GET['page'].'.controller.php')) {
            die("404 page not found - <a href=\"javascript:history.back()\">Go Back</a>");
        }
    }

    // include the MVC-files
    require_once($path['models'].$page.'.model.php');
    require_once($path['views'].$page.'.view.php');
    require_once($path['controllers'].$page.'.controller.php');

    // load the controller
    switch($page) {
        case 'overview':
            $controller = new C_Overview($_GET, $_POST);
            break;
        case 'resources':
            $controller = new C_Resources($_GET, $_POST);
            break;
        case 'buildings':
            $controller = new C_Building($_GET, $_POST);
            break;
        case 'research':
            $controller = new C_Research($_GET, $_POST);
            break;
        case 'shipyard':
            $controller = new C_Shipyard($_GET, $_POST);
            break;
        case 'galaxy':
            $controller = new C_Galaxy($_GET, $_POST);
            break;
        case 'settings':
            $controller = new C_Settings($_GET, $_POST);
            break;
        case 'changelog':
            $controller = new C_Changelog($_GET, $_POST);
            break;
    }

    $lang['admin_link'] = ($userID == 1) ? '<li><a href="admin.php" style="color:lime;"><i class="fa fa-user-circle-o"></i> Admin</a></li>' : 'x';

    // get coords for galaxy menu-link
    $lang["g"] = $data->getPlanet()->getGalaxy();
    $lang["s"] = $data->getPlanet()->getSystem();

    // display the page
    $controller->display();



    /**
     * loads all relevant user-information (planet, buildings, fleet, tech, defense etc.)
     * @param $userID the user id
     * @return Loader an object containing all the information
     * @throws FileNotFoundException
     */
    function loadUserData($userID) {
        global $path;

        $file = $path['classes'] . 'loader.class.php';
        if(file_exists($file)) {
            require_once($file);
        } else {
            throw new FileNotFoundException('File \''.$file.'\' not found');
        }

        return new Loader($userID);
    }
