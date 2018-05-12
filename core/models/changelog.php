<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class M_Changelog implements I_Model {

        public function loadLanguage() {

            global $path, $lang, $config;

            require Config::$gameConfig['language'] . Config::$pathConfig['language'] . '/changelog.php';

            return $lang;
        }
    }
