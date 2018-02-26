<?php

    function __autoload($className) {
        global $path;

        $s = explode("_", $className);

        $p = "";

        switch ($s[0]) {
            case "Data":
                $p = $path['data'] . strtolower($s[1]) . '.php';
                break;
            case "Unit":
                $p = $path['units'] . strtolower($s[1]) . '.php';
                break;
            case "C":
                $p = $path['controllers'] . strtolower($s[1]) . '.php';
                break;
            case "I":
                $p = $path['interfaces'] . strtolower($s[1]) . '.php';
                break;
            case "V":
                $p = $path['views'] . strtolower($s[1]) . '.php';
                break;
            case "M":
                $p = $path['models'] . strtolower($s[1]) . '.php';
                break;
            case "Loader":
                $p = $path['classes'] . strtolower($s[0]) . '.php';
                break;
            case "Database":
                $p = $path['classes'] . 'db.php';
                break;
            case "Debug":
                $p = $path['classes'] . 'debug.php';
                break;
        }

        if (file_exists($p)) {
            require_once $p;
        }


    }