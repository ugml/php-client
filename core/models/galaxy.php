<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    require $path['interfaces'] . 'model.php';

    class M_Galaxy implements I_Model {

        /**
         * loads the required language files
         * @return array the loaded language-array
         * @throws FileNotFoundException
         */
        public static function loadLanguage() {

            global $path, $config, $lang;

            $file = $path['language'] . $config['language'] . '/galaxy.php';
            if (file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            $file = $path['language'] . $config['language'] . '/units.php';
            if (file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            $file = $path['language'] . $config['language'] . '/menu.php';
            if (file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            return $lang;
        }

        public static function loadGalaxyData($galaxy, $system) {

            global $database;

            try {
                $db = connectToDB();

                $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $params = array(':galaxy' => $galaxy,
                                ':system' => $system
                );

                $stmt = $db->prepare('SELECT u.username, p.name, p.planet FROM ' . $database['prefix'] . 'planets AS p LEFT JOIN ' . $database['prefix'] . 'users AS u ON u.userID = p.ownerID WHERE p.galaxy = :galaxy AND p.system = :system ORDER BY p.planet ASC');

                $stmt->execute($params);


                while (($data = $stmt->fetch()) != null) {
                    echo $data->username;
                    echo " ";
                    echo $data->name;
                    echo " [";
                    echo $galaxy;
                    echo ":";
                    echo $system;
                    echo ":";
                    echo $data->planet;
                    echo "]";
                    echo "<br />";
                    //                    echo $data->username + " " + $data->name + " [" + $galaxy + ":" + $system + ":" + $data->planet + "]";
                }

            } catch (PDOException $e) {
                die($e);
            }
        }

        /**
         * loads all relevant user-information (planet, buildings, fleet, tech, defense etc.)
         * @param $userID the user id
         * @return Loader an object containing all the information
         * @throws FileNotFoundException
         */
        public static function loadUserData($userID) {

            global $path;

            $file = $path['classes'] . 'loader.php';
            if (file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            return new Loader($userID);
        }

    }
