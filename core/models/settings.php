<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class M_Settings implements I_Model {

        /**
         * loads the required language files
         * @return array the loaded language-array
         * @throws FileNotFoundException
         */
        public function loadLanguage() {

            global $path, $config, $lang;

            $file = Config::$gameConfig['language'] . Config::$pathConfig['language'] . '/settings.php';
            if (file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            $file = Config::$gameConfig['language'] . Config::$pathConfig['language'] . '/units.php';
            if (file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            $file = Config::$gameConfig['language'] . Config::$pathConfig['language'] . '/menu.php';
            if (file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            return $lang;
        }
    }
