<?php

    /**
     * Automatically loads the needed classes
     * @param string $className the class, which should be included
     */
    function __autoload(string $className) {
        global $path;

        // classes have the naming convention [FirstLetterOfType]_Name
        // e.g. the Data-class of a planet would be D_Planet
        //
        // split the given class name
        $s = explode("_", $className);

        $p = "";

        // switch the first part of the class name
        switch ($s[0]) {
            case "D":
                $p = $path['data'] . strtolower($s[1]) . '.php';
                break;
            case "U":
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

        // if the file exists
        if (file_exists($p)) {
            // require it
            require_once $p;
        }


    }