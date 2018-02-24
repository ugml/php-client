<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class M_Shipyard implements I_Model {

        /**
         * loads the required language files
         * @return array the loaded language-array
         * @throws FileNotFoundException
         */
        public static function loadLanguage() {

            global $path, $config, $lang;

            $file = $path['language'] . $config['language'] . '/shipyard.php';
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

        public static function build(int $planetID, array $buildingQueue, int $costMetal, int $costCrystal,
            int $costDeuterium) {

            global $database, $db, $data;

            if ($data->getUser()
                    ->getCurrentPlanet() != $planetID || $costMetal < 0 || $costCrystal < 0 || $costDeuterium < 0) {
                throw new InvalidArgumentException('Passed arguments are not valid');
                //break;
            }

            try {

                // append to current queue
                if ($data->getPlanet()->getBHangarId() !== "0") {
                    $buildingString = $data->getPlanet()->getBHangarId();
                }

                foreach ($buildingQueue as $k => $v) {
                    $key = key($v);

                    $buildingString .= $key . "," . $v[$key] . ";\n";
                }


                $params = array(
                    ':b_hangar_start_time' => time(),
                    ':b_hangar_id'         => $buildingString,
                    ':metal'               => $data->getPlanet()->getMetal() - $costMetal,
                    ':crystal'             => $data->getPlanet()->getCrystal() - $costCrystal,
                    ':deuterium'           => $data->getPlanet()->getDeuterium() - $costDeuterium,
                    ':planetID'            => $planetID
                );

                $stmt = $db->prepare('UPDATE ' . $database['prefix'] . 'planets SET 
                                            b_hangar_start_time = :b_hangar_start_time, 
                                            b_hangar_id = :b_hangar_id, 
                                            metal = :metal, 
                                            crystal = :crystal, 
                                            deuterium = :deuterium 
                                        WHERE planetID = :planetID;');

                $stmt->execute($params);
            } catch (PDOException $e) {
                die($e);
            }

        }
    }
