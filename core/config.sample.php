<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    define('DEBUG', false);

    $root = $_SERVER['DOCUMENT_ROOT'] . '/ugamela/';

    $config = [
        'basepath' =>  $root . '',
        'game_name' => 'ugamela',
        'copyright' => 'Copyright by ugamela &copy; 2017',
        'language' => 'en',
        'max_galaxy' => 9,
        'max_system' => 100,
        'max_planet' => 15,
        'skinpath' => 'skins/Maya/'
    ];


    $database = [
        'host' => 'DB-HOST',
        'port' => 'DB-PORT',
        'dbname' => 'DB-NAME',
        'user' => 'DB-USERNAME',
        'pass' => 'DB-PASSWORD',
        'prefix' => 'DB-PREFIX'
    ];

    $base_income = [
        'metal' => 500,
        'crystal' => 250,
        'deuterium' => 0,
        'energy' => 0
    ];

    $path = [
      'interfaces' => $config['basepath'].'core/interfaces/',
      'controllers' => $config['basepath'].'core/controllers/',
      'models' => $config['basepath'].'core/models/',
      'views' => $config['basepath'].'core/views/',
      'classes' => $config['basepath'].'core/classes/',
      'language' => $config['basepath'].'core/language/',
      'templates' => $config['basepath'].'core/templates/'
    ];
    

    $lang['game_name'] = $config['game_name'];
    $lang['language'] = $config['language'];
    $lang['copyright'] = $config['copyright'];

    require_once $path['classes'].'debug.class.php';
    require_once $path['classes'].'db.class.php';
    
    $debug = new Debug();

    if(DEBUG) {
        error_reporting(E_ALL & ~E_NOTICE);
        ini_set('display_errors', 1);
        require_once('LoggedPDO.php');
    }
