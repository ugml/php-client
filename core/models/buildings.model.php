<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    require $path['interfaces'].'model.interface.php';

    class M_Buildings implements I_Model {

        /**
         * loads the required language files
         * @return array the loaded language-array
         * @throws FileNotFoundException
         */
        public static function loadLanguage() {
            global $path, $config, $lang;

            $file = $path['language'] . $config['language'] . '/buildings.language.php';
            if(file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \''.$file.'\' not found');
            }

            $file = $path['language'] . $config['language'] . '/units.language.php';
            if(file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \''.$file.'\' not found');
            }

            $file = $path['language'] . $config['language'] . '/menu.language.php';
            if(file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \''.$file.'\' not found');
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

            $file = $path['classes'] . 'loader.class.php';
            if(file_exists($file)) {
                require $file;
            } else {
                throw new FileNotFoundException('File \''.$file.'\' not found');
            }

            return new Loader($userID);
        }

        public static function build($planetID, $buildID, $toLvl, $metal, $crystal, $deuterium) {
            global $database, $config, $db, $data;

            // check if requirements are met
            $req_met = true;

            // check requirements
            if ($data->getUnits()->getRequirements($buildID) !== []) {

                $req = $data->getUnits()->getRequirements($buildID);

                foreach ($req as $bID => $lvl) {

                    if (!$req_met) {
                        break;
                    }

                    $methodArr = explode('_', $data->getUnits()->getUnit($bID));

                    $method = 'get';

                    foreach ($methodArr as $a => $b) {
                        $method .= ucfirst($b);
                    }

                    // if requirement is a building
                    if ($bID < 100) {
                        $level = call_user_func_array(array($data->getBuilding(), $method), array());
                    }

                    // if requirement is a research
                    if ($bID > 100 && $bID < 200) {
                        $level = call_user_func_array(array($data->getTech(), $method), array());
                    }

                    if ($level < $lvl) {
                        throw new InvalidArgumentException('Requirements not met');
                        break;
                    }

                }
            }

            if($data->getPlanet()->getBBuildingId() == 0 && $data->getPlanet()->getBBuildingEndtime() == 0) {
                if($buildID > 0 && $metal >= 0 && $crystal >= 0 && $deuterium >= 0) {
                    try {

                        $buildTime = time() + 3600 * $data->getUnits()->getBuildTime($buildID,$toLvl,$data->getBuilding()->getRoboticFactory(),$data->getBuilding()->getShipyard(),$data->getBuilding()->getNaniteFactory());

                        $params = array(':b_building_id' => $buildID,
                            ':b_building_endtime' => $buildTime,
                            ':metal' => $metal,
                            ':crystal' => $crystal,
                            ':deuterium' => $deuterium,
                            ':planetID' => $planetID
                        );

                        $stmt = $db->prepare('UPDATE ' . $database['prefix'] . 'planets SET b_building_id = :b_building_id, b_building_endtime = :b_building_endtime, metal = :metal, crystal = :crystal, deuterium = :deuterium WHERE planetID = :planetID;');

                        $stmt->execute($params);
                    } catch (PDOException $e) {
                        die($e);
                    }
                } else {
                    throw new InvalidArgumentException('Passed arguments are not valid');
                }
            } else {
                throw new UnexpectedValueException('a building is already in the buildingqueue');
            }

        }

        public static function cancel($planetID, $metal, $crystal, $deuterium) {
            global $database, $db, $data;

            if($data->getPlanet()->getBBuildingId() > 0 && $data->getPlanet()->getBBuildingEndtime() > 0) {
                if($planetID > 0 && $metal >= 0 && $crystal >= 0 && $deuterium >= 0) {
                    try {

                        $params = array(':planetID' => $planetID,
                            ':metal' => $metal,
                            ':crystal' => $crystal,
                            ':deuterium' => $deuterium
                        );

                        $stmt = $db->prepare('UPDATE ' . $database['prefix'] . 'planets SET b_building_id = 0, b_building_endtime = 0, metal = metal+:metal, crystal = crystal+:crystal, deuterium = deuterium+:deuterium WHERE planetID = :planetID;');

                        $stmt->execute($params);
                    } catch (PDOException $e) {
                        die($e);
                    }
                } else {
                    throw new InvalidArgumentException('Passed arguments are not valid');
                }
            } else {
                throw new UnexpectedValueException('no building is currently in the buildingqueue');
            }
        }
    }
