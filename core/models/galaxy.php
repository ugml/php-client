<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class M_Galaxy implements I_Model {

        public static function loadGalaxyData($galaxy, $system) {

            global $debug;

            try {

                $dbConnection = new Database();

                $params = array(':galaxy' => $galaxy,
                                ':system' => $system
                );

                $stmt = $dbConnection->prepare('SELECT p.planetID, p.name, p.image, p.planet, u.userID, u.username, u.onlinetime, 
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

                return $rows;

            } catch (PDOException $e) {
                if (DEBUG) {
                    $debug->addLog(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                } else {
                    $debug->saveError(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                }
            }
        }

        /**
         * loads the required language files
         * @return array the loaded language-array
         * @throws FileNotFoundException
         */
        public function loadLanguage() {

            global $lang;

            $file = Config::$pathConfig['language'] . Config::$gameConfig['language'] . '/galaxy.php';
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

    }
