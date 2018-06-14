<?php

    define('INSIDE', true);

    require_once "../core/config.php";
    require_once "../core/classes/data/units.php";

    Config::init();
    D_Units::init();

    header('Content-Type: application/json');

    echo json_encode(D_Units::jsonSerialize());
    die();