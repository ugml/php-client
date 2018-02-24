<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class M_Building implements I_Model {

        /**
         * loads the required language files
         * @return array the loaded language-array
         * @throws FileNotFoundException
         */
        public static function loadLanguage() {

            global $path, $config, $lang;

            $file = $path['language'] . $config['language'] . '/buildings.php';
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

        public static function build($planetID, $buildID, $toLvl, $metal, $crystal, $deuterium) {

            global $database, $config, $db, $data, $units;

            // check if requirements are met
            $req_met = true;

            // check requirements
            if ($units->getRequirements($buildID) !== []) {


                $req = $units->getRequirements($buildID);

                foreach ($req as $bID => $lvl) {

                    if (!$req_met) {
                        break;
                    }

                    // if requirement is a building
                    if ($bID < 100) {
                        $level = $data->getBuilding()[$buildID]->getLevel();
                    }

                    // if requirement is a research
                    if ($bID > 100 && $bID < 200) {
                        $level = $data->getTech()[$buildID]->getLevel();
                    }

                    if ($level < $lvl) {
                        throw new InvalidArgumentException('Requirements not met');
                        break;
                    }

                }
            }

            if ($data->getPlanet()->getBBuildingId() == 0 && $data->getPlanet()->getBBuildingEndtime() == 0) {
                if ($buildID > 0 && $metal >= 0 && $crystal >= 0 && $deuterium >= 0) {
                    try {

                        $buildTime = time() + 3600 * $units->getBuildTime($buildID, $toLvl,
                                $data->getBuilding()['robotic_factory'],
                                $data->getBuilding()['shipyard'], $data->getBuilding()['nanite_factory']);


                        $params = array(':b_building_id'      => $buildID,
                                        ':b_building_endtime' => $buildTime,
                                        ':metal'              => $metal,
                                        ':crystal'            => $crystal,
                                        ':deuterium'          => $deuterium,
                                        ':planetID'           => $planetID
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
                throw new UnexpectedFalueException('a building is already in the buildingqueue');
            }

        }

        public static function cancel($planetID, $metal, $crystal, $deuterium) {

            global $database, $db, $data;

            if ($data->getPlanet()->getBBuildingId() > 0 && $data->getPlanet()->getBBuildingEndtime() > 0) {
                if ($planetID > 0 && $metal >= 0 && $crystal >= 0 && $deuterium >= 0) {
                    try {

                        $params = array(':planetID'  => $planetID,
                                        ':metal'     => $metal,
                                        ':crystal'   => $crystal,
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
