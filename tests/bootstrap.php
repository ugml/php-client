<?php

    if (!defined('INSIDE')) {
        define('INSIDE', true);
    }

    require_once 'config.php';

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
    require_once dirname(dirname(__FILE__)) . "/core/classes/units/defense.php";
    require_once dirname(dirname(__FILE__)) . "/core/classes/units/fleet.php";


    // initialize static objects
    Config::init();
    D_Units::init();


