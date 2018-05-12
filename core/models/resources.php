<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class M_Resources implements I_Model {

        /**
         * loads the required language files
         * @return array the loaded language-array
         * @throws FileNotFoundException
         */
        public function loadLanguage() {

            global $lang;

            $file = Config::$pathConfig['language'] . Config::$gameConfig['language'] . '/resources.php';
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

        /**
         * updates the production levels for each ressource-producing building
         * @param $planetID the current planet id
         * @param $levels   the level of the building (or the amount of a unit)
         * @throws InvalidArgumentException
         */
        public static function updateProductionLevels($planetID, $levels) {

            global $dbConfig;

            $query_values = '';
            foreach ($levels as $k => $v) {
                // illegal values
                if ($v > 100 || $v < 0 || $v == null || !is_numeric($v) || $v % 10 != 0) {
                    throw new InvalidArgumentException('updateProductionLevels only accepts integers');
                } else {
                    $query_values .= $k . '_percent = \'' . $v . '\', ';
                }
            }

            // update the planet
            $dbConnection = connectToDB();

            $dbConnection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbConnection->prepare('UPDATE ' . $dbConfig['prefix'] . 'planets SET ' . rtrim($query_values,
                    ', ') . ' WHERE planetID = :planetid');

            $stmt->bindParam(':planetid', $planetID);

            $stmt->execute();
        }

    }
