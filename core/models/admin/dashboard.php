<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class M_Dashboard implements I_Model {

        /**
         * loads the required language files
         * @return array the loaded language-array
         * @throws FileNotFoundException
         */
        public function loadLanguage() {

            global $lang;

            $file = Config::$pathConfig['language'] . Config::$gameConfig['language'] . '/admin/dashboard.php';
            if (file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            $file = Config::$pathConfig['language'] . Config::$gameConfig['language'] . '/menu.php';
            if (file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            return $lang;
        }

        /**
         * loads all relevant user-information (planet, buildings, fleet, tech, defense etc.)
         * @param $userID the user id
         * @return Loader an object containing all the information
         * @throws FileNotFoundException
         */
        public static function loadUserData($userID) {



            $file = Config::$pathConfig['classes'] . 'loader.php';
            if (file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            return new Loader($userID);
        }

    }
