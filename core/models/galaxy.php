<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class M_Galaxy implements I_Model {

        /**
         * loads the required language files
         * @return array the loaded language-array
         * @throws FileNotFoundException
         */
        public function loadLanguage() {

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

            global $database, $db;

            try {

                $params = array(':galaxy' => $galaxy,
                                ':system' => $system
                );

                $stmt = $db->prepare('SELECT p.planetID, p.name, p.image, p.planet, u.userID, u.username, u.onlinetime, 
                                             g.debris_metal, g.debris_crystal, m.planetID AS moonID FROM planets AS p 
                                             LEFT JOIN users AS u ON u.userID = p.ownerID 
                                             LEFT JOIN galaxy AS g ON g.planetID = p.planetID 
                                             LEFT JOIN planets AS m ON m.galaxy = p.galaxy AND m.system = p.system AND m.planet = p.planet AND m.planet_type = 2 
                                             WHERE p.galaxy = :galaxy AND p.system = :system AND p.planet_type = 1 ORDER BY p.planet ASC');



                $stmt->execute($params);

                $rows = [];

                while (($data = $stmt->fetch()) != null) {
                    $rows[$data->planet] = $data;
                }

//                echo "<pre>";
//                print_r($rows);
//                echo "</pre>";

                return $rows;

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
