<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class M_Users {

        /**
         * loads all relevant user-information (planet, buildings, fleet, tech, defense etc.)
         * @param $userID the user id
         * @return Loader an object containing all the information
         * @throws FileNotFoundException
         */
        public static function loadUsers() {

            $dbConnection = new PDO('mysql:host=' . Config::$dbConfig['host'] . ';dbname=' . Config::$dbConfig['dbname'],
                Config::$dbConfig['user'],
                Config::$dbConfig['pass']);

            $dbConnection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = 'SELECT 
                        userID AS user_userID, 
                        username AS user_username, 
                        onlinetime AS user_onlinetime,
                        currentplanet AS user_currentplanet
                      FROM users
                      ORDER BY user_userID;';

            $stmt = $dbConnection->prepare($query);

            $stmt->execute();

            return $stmt->fetchAll();


        }

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

    }
