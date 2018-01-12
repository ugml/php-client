<?php

defined('INSIDE') OR exit('No direct script access allowed');

require $path['interfaces'].'model.interface.php';

class M_Changelog implements I_Model {

    public static function loadLanguage() {
        global $path, $lang, $config;

        require $path['language'] . $config['language'] . '/changelog.language.php';

        return $lang;
    }
}
