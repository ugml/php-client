<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class M_Shipyard implements I_Model {

        /**
         * loads the required language files
         * @return array the loaded language-array
         * @throws FileNotFoundException
         */
        public function loadLanguage() {

            global $lang;

            $file = Config::$pathConfig['language'] . Config::$gameConfig['language'] . '/shipyard.php';
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
        public function loadUserData($userID) {


            $file = Config::$pathConfig['classes'] . 'loader.php';
            if (file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            return new Loader($userID);
        }

        public function build(int $planetID, array $buildingQueue, int $costMetal, int $costCrystal, int $costDeuterium) {
            global $debug;

            if (Loader::getUser()
                    ->getCurrentPlanet() != $planetID || $costMetal < 0 || $costCrystal < 0 || $costDeuterium < 0) {
                throw new InvalidArgumentException('Passed arguments are not valid');
                //break;
            }

            try {

                // append to current queue
                if (Loader::getPlanet()->getBHangarId() !== "0") {
                    $buildingString = Loader::getPlanet()->getBHangarId();
                }

                foreach ($buildingQueue as $k => $v) {
                    $key = key($v);

                    $buildingString .= $key . "," . $v[$key] . ";\n";
                }


                $params = array(
                    ':b_hangar_start_time' => time(),
                    ':b_hangar_id'         => $buildingString,
                    ':metal'               => Loader::getPlanet()->getMetal() - $costMetal,
                    ':crystal'             => Loader::getPlanet()->getCrystal() - $costCrystal,
                    ':deuterium'           => Loader::getPlanet()->getDeuterium() - $costDeuterium,
                    ':planetID'            => $planetID
                );

                $dbConnection = new Database();

                $stmt = $dbConnection->prepare('UPDATE ' . Config::$dbConfig['prefix'] . 'planets SET 
                                            b_hangar_start_time = :b_hangar_start_time, 
                                            b_hangar_id = :b_hangar_id, 
                                            metal = :metal, 
                                            crystal = :crystal, 
                                            deuterium = :deuterium 
                                        WHERE planetID = :planetID;');

                $stmt->execute($params);

                Loader::getPlanet()->setMetal(Loader::getPlanet()->getMetal() - $costMetal);
                Loader::getPlanet()->setCrystal(Loader::getPlanet()->getCrystal() - $costCrystal);
                Loader::getPlanet()->setDeuterium(Loader::getPlanet()->getDeuterium() - $costDeuterium);

            } catch (PDOException $e) {
                if (DEBUG) {
                    $debug->addLog(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                } else {
                    $debug->saveError(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                }
            }

        }
    }
