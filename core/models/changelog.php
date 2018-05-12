<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class M_Changelog implements I_Model {

        public function loadLanguage() {

            global $lang, Config::$gameConfig;

            require Config::$pathConfig['language'] . Config::$gameConfig['language'] . '/changelog.php';

            return $lang;
        }
    }
