<?php


    if (!defined('INSIDE')) {
        define('INSIDE', true);
    }

    // enable debug-mode
    define('DEBUG', false);

    $root = dirname(dirname(__FILE__));

    define('PRODUCTION', false);


    $config = [
        'basepath'   => $root . "/",
        'game_name'  => 'ugamela',
        'copyright'  => 'Copyright by ugamela &copy; 2017',
        'language'   => 'en',
        'max_galaxy' => 9,
        'max_system' => 100,
        'max_planet' => 15,
        'skinpath'   => 'skins/Maya/'
    ];

    $dbConfig = [
        'host'   => '172.25.0.100',
        'port'   => '3306',
        'dbname' => 'ugamela',
        'user'   => 'root',
        'pass'   => '',
        'prefix' => ''
    ];


    $base_income = [
        'metal'     => 500,
        'crystal'   => 250,
        'deuterium' => 0,
        'energy'    => 0
    ];

    $path = [
        'interfaces'  => $config['basepath'] . 'core/interfaces/',
        'controllers' => $config['basepath'] . 'core/controllers/',
        'models'      => $config['basepath'] . 'core/models/',
        'views'       => $config['basepath'] . 'core/views/',
        'classes'     => $config['basepath'] . 'core/classes/',
        'data'        => $config['basepath'] . 'core/classes/data/',
        'units'       => $config['basepath'] . 'core/classes/units/',
        'language'    => $config['basepath'] . 'core/language/',
        'templates'   => $config['basepath'] . 'core/templates/'
    ];


    $lang['game_name'] = $config['game_name'];
    $lang['language'] = Config::$pathConfig['language'];
    $lang['copyright'] = $config['copyright'];

//    require_once $path['classes'] . 'debug.php';

//    $debug = new Debug();
//
//    if (DEBUG) {
//        error_reporting(E_ALL & ~E_NOTICE);
//        ini_set('display_errors', 1);
//        require_once('LoggedPDO.php');
//    }
