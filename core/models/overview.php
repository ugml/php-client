<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class M_Overview implements I_Model {

        /**
         * loads the required language files
         * @return array the loaded language-array
         * @throws FileNotFoundException
         */
        public function loadLanguage() : array {

            global $lang;

            $file = Config::$pathConfig['language'] . Config::$gameConfig['language'] . '/overview.php';
            if (file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            $file = Config::$pathConfig['language'] . Config::$gameConfig['language'] . '/units.php';
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
         * @return int the number of registered users
         */
        public function getNumUsers() : int {
            global $dbConnection, $dbConfig;


            $query = 'SELECT COUNT(userID) FROM ' . $dbConfig['prefix'] . 'users;';

            $stmt = $dbConnection->prepare($query);

            $stmt->execute();

            return $stmt->fetchColumn(0);
        }
    }
