<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class M_Fleet implements I_Model {

        /**
         * loads the required language files
         * @return array the loaded language-array
         * @throws FileNotFoundException
         */
        public function loadLanguage() {

            global $lang;

            $file = Config::$pathConfig['language'] . Config::$gameConfig['language'] . '/fleet.php';
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

        public function loadAvailableShips() : array {
            $dbConnection = new Database();

            $params = array(':planetID' => Loader::getPlanet()->getPlanetID());

            $stmt = $dbConnection->prepare('SELECT * FROM '.Config::$dbConfig['prefix'].'fleet WHERE planetID = :planetID');


            $stmt->execute($params);

            $data = $stmt->fetchAll();

            return $data;
        }

        public function loadCurrentMissions() : array {

            $dbConnection = new Database();

            $params = array(':ownerID' => Loader::getUser()->getUserID());

            $stmt = $dbConnection->prepare('SELECT * FROM '.Config::$dbConfig['prefix'].'flights WHERE ownerID = :ownerID AND processed = 0');


            $stmt->execute($params);

            $data = $stmt->fetchAll();

            return $data;
        }

        public function sendFleet(int $galaxy, int $system, int $planet, int $mission, int $type, int $metal, int $crystal, int $deuterium, array $fleetData) : int {

            $dbConnection = new Database();

            // 1. check if a planet exists at the destination
            $params = array(':galaxy' => $galaxy,
                            ':system' => $system,
                            ':planet' => $planet,
                            ':type' => $type);

            $stmt = $dbConnection->prepare("SELECT p.planetID FROM planets AS p WHERE p.galaxy = :galaxy AND p.system = :system AND p.planet = :planet AND p.planet_type = :type;");

            $stmt->execute($params);

            $data = $stmt->fetchAll();

            if(count($data) == 1) {

                $fleetDataString = "";

                $fleetUpdateQuery = "UPDATE fleet SET ";
                foreach($fleetData as $key => $value) {
                    $fleetDataString .= $key . "," . $value . ";";

                    $fleetUpdateQuery .= D_Units::getUnitName($key) . " = " . (Loader::getFleetData()->getFleetByID($key) - $value) . ", ";

                    Loader::getFleetData()->setFleetByID($key, $value);

                }

                $fleetUpdateQuery = substr($fleetUpdateQuery, 0, strlen($fleetUpdateQuery) - 2);

                $fleetUpdateQuery .= " WHERE planetID = " . Loader::getPlanet()->getPlanetID() . ";";

                // update fleet
                $stmt = $dbConnection->prepare($fleetUpdateQuery);

                $stmt->execute();

                // send fleet
                $stmt = $dbConnection->prepare("INSERT INTO `flights` (`flightID`, `ownerID`, `mission`, `fleetlist`, `start_id`, `start_type`, `start_time`, `end_id`, `end_type`, `end_time`, `loaded_metal`, `loaded_crystal`, `loaded_deuterium`, `returning`, `processed`) VALUES 
                                                                            (NULL, '".Loader::getUser()->getUserID()."', '".$mission."', '".$fleetDataString."', '".Loader::getPlanet()->getPlanetID()."', '1', '".time()."', '". $data[0]->planetID ."', '1', '". (time() + 1000) ."', '".$metal."', '".$crystal."', '".$deuterium."', '0', '0');");

                $stmt->execute();


                // update the planet
                $params = array(':metal' => Loader::getPlanet()->getMetal() - $metal,
                                ':crystal' => Loader::getPlanet()->getCrystal() - $crystal,
                                ':deuterium' => Loader::getPlanet()->getDeuterium() - $deuterium,
                                ':planetID' => Loader::getPlanet()->getPlanetID());

                $query = "UPDATE planets SET metal = :metal, crystal = :crystal, deuterium = :deuterium WHERE planetID = :planetID;";

                $stmt = $dbConnection->prepare($query);

                $stmt->execute($params);


                Loader::getPlanet()->setMetal(Loader::getPlanet()->getMetal() - $metal);
                Loader::getPlanet()->setCrystal(Loader::getPlanet()->getCrystal() - $crystal);
                Loader::getPlanet()->setDeuterium(Loader::getPlanet()->getDeuterium() - $deuterium);

                return 0;

            } else {
                // planet does not exist
                return -1;
            }


        }

    }
