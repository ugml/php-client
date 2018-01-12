<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    require $path['interfaces'].'model.interface.php';

    class M_Dashboard implements I_Model {

        /**
         * loads the required language files
         * @return array the loaded language-array
         * @throws FileNotFoundException
         */
        public static function loadLanguage() {
            global $path, $config, $lang;

            $file = $path['language'] . $config['language'] . '/admin/dashboard.language.php';
            if(file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \''.$file.'\' not found');
            }

            $file = $path['language'] . $config['language'] . '/menu.language.php';
            if(file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \''.$file.'\' not found');
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
            global $path;

            $file = $path['classes'] . 'loader.class.php';
            if(file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \''.$file.'\' not found');
            }

            return new Loader($userID);
        }

    }
