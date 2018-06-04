<?php

    if (!defined('INSIDE')) {
        define('INSIDE', true);
    }

    require_once 'config.php';

    Config::init();

    // TODO: autoloading
    require_once dirname(dirname(__FILE__)) . '/core/classes/database.php';
    require_once dirname(dirname(__FILE__)) . '/core/classes/loader.php';
    require_once dirname(dirname(__FILE__)) . '/core/classes/debug.php';

    $debug = new Debug();

    require_once dirname(dirname(__FILE__)) . '/core/classes/data/units.php';
    require_once dirname(dirname(__FILE__)) . '/core/classes/data/building.php';
    require_once dirname(dirname(__FILE__)) . "/core/classes/data/user.php";
    require_once dirname(dirname(__FILE__)) . "/core/classes/data/units.php";
    require_once dirname(dirname(__FILE__)) . "/core/classes/data/tech.php";
    require_once dirname(dirname(__FILE__)) . "/core/classes/data/planet.php";
    require_once dirname(dirname(__FILE__)) . "/core/classes/data/galaxy.php";
    require_once dirname(dirname(__FILE__)) . "/core/classes/data/fleet.php";
    require_once dirname(dirname(__FILE__)) . "/core/classes/data/defense.php";
    require_once dirname(dirname(__FILE__)) . "/core/classes/data/building.php";

    require_once dirname(dirname(__FILE__)) . "/core/classes/units/unit.php";
    require_once dirname(dirname(__FILE__)) . "/core/classes/units/research.php";
    require_once dirname(dirname(__FILE__)) . "/core/classes/units/building.php";
    require_once dirname(dirname(__FILE__)) . "/core/classes/units/planet.php";
    require_once dirname(dirname(__FILE__)) . "/core/classes/units/defense.php";
    require_once dirname(dirname(__FILE__)) . "/core/classes/units/fleet.php";


    require_once dirname(dirname(__FILE__)) . "/core/interfaces/controller.php";
    require_once dirname(dirname(__FILE__)) . "/core/interfaces/model.php";
    require_once dirname(dirname(__FILE__)) . "/core/interfaces/view.php";
    require_once dirname(dirname(__FILE__)) . "/core/models/building.php";
    require_once dirname(dirname(__FILE__)) . "/core/views/view.php";
    require_once dirname(dirname(__FILE__)) . "/core/views/building.php";
    require_once dirname(dirname(__FILE__)) . "/core/controllers/building.php";


    // initialize static objects
    D_Units::init();
    Loader::init(1);


