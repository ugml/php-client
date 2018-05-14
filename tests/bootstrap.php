<?php

    if (!defined('INSIDE')) {
        define('INSIDE', true);
    }

    require_once 'config.php';

    spl_autoload_register(function (string $className) {
        // classes have the naming convention [FirstLetterOfType]_Name
        // e.g. the Data-class of a planet would be D_Planet
        //
        // split the given class name
        $s = explode("_", $className);

        $p = "";

        // switch the first part of the class name
        switch ($s[0]) {
            case "D":
                $p = Config::$pathConfig['data'] . strtolower($s[1]) . '.php';
                break;
            case "U":
                $p = Config::$pathConfig['units'] . strtolower($s[1]) . '.php';
                break;
            case "C":
                $p = Config::$pathConfig['controllers'] . strtolower($s[1]) . '.php';
                break;
            case "I":
                $p = Config::$pathConfig['interfaces'] . strtolower($s[1]) . '.php';
                break;
            case "V":
                $p = Config::$pathConfig['views'] . strtolower($s[1]) . '.php';
                break;
            case "M":
                $p = Config::$pathConfig['models'] . strtolower($s[1]) . '.php';
                break;
            case "Loader":
                $p = Config::$pathConfig['classes'] . strtolower($s[0]) . '.php';
                break;
            case "Database":
                $p = Config::$pathConfig['classes'] . 'database.php';
                break;
            case "Debug":
                $p = Config::$pathConfig['classes'] . 'debug.php';
                break;
            case "Config":
                $p = 'test/config.php';
                break;
        }

        // if the file exists
        if (file_exists($p)) {
            // require it
            require_once $p;
        }


    });


    // initialize config
    Config::init();


