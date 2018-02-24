<?php

    function __autoload($className) {

        $s = explode("_", $className);

        $p = "";

        switch ($s[0]) {
            case "Data":
                $p = '../core/classes/data/' . strtolower($s[1]) . '.php';
                break;
            case "Unit":
                $p = '../core/classes/units/' . strtolower($s[1]) . '.php';
                break;
            case "C":
                $p = '../core/controllers/' . strtolower($s[1]) . '.php';
                break;
            case "I":
                $p = '../core/interfaces/' . strtolower($s[1]) . '.php';
                break;
            case "V":
                $p = '../core/views/' . strtolower($s[1]) . '.php';
                break;
            case "M":
                $p = '../core/models/' . strtolower($s[1]) . '.php';
                break;
            case "Loader":
                $p = '../core/classes/loader.php';
                break;
            case "Database":
                $p = '../core/classes/db.php';
                break;
        }

        if (file_exists($p)) {
            require_once $p;
        }


    }