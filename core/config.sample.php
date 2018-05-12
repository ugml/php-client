<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    // enable debug-mode
    /* @var DEBUG boolean constant which enables/disabled the debug-mode */
    define('DEBUG', false);

    $root = $_SERVER['DOCUMENT_ROOT'] . '/ugamela/';

    $config = [
        'basepath'   => $root . '',
        'game_name'  => 'ugamela',
        'copyright'  => 'Copyright by ugamela &copy; 2017',
        'language'   => 'en',
        'max_galaxy' => 9,
        'max_system' => 100,
        'max_planet' => 15,
        'skinpath'   => 'skins/Maya/'
    ];


    $dbConfig = [
        'host'   => 'MYSQL_HOST',
        'port'   => 'MYSQL_PORT',
        'dbname' => 'MYSQL_DB_NAME',
        'user'   => 'MYSQL_USERNAME',
        'pass'   => 'MYSQL_PASSWORD',
        'prefix' => 'MYSQL_TABLE_PREFIX'
    ];

    // base_income per hour
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
    $lang['ugamela_version'] = "0.0.1-alpha";

    if (DEBUG) {
        $debug = new Debug();
        error_reporting(E_ALL & ~E_NOTICE);
        ini_set('display_errors', 1);
        require_once('LoggedPDO.php');
    }
