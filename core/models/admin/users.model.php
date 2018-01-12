<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class M_Users {

        /**
         * loads the required language files
         * @return array the loaded language-array
         * @throws FileNotFoundException
         */
        public static function loadLanguage() {

            global $path, $config, $lang;

            $file = $path['language'] . $config['language'] . '/admin/dashboard.language.php';
            if (file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            $file = $path['language'] . $config['language'] . '/menu.language.php';
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
        public static function loadUsers() {

            global $database;

            $db = new PDO('mysql:host=' . $database['host'] . ';dbname=' . $database['dbname'], $database['user'],
                $database['pass']);

            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = 'SELECT 
                        userID AS user_userID, 
                        username AS user_username, 
                        onlinetime AS user_onlinetime,
                        currentplanet AS user_currentplanet
                      FROM users
                      ORDER BY user_userID;';

            $stmt = $db->prepare($query);

            $stmt->execute();

            return $stmt->fetchAll();


        }

    }
