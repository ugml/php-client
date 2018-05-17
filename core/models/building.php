<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class M_Building implements I_Model {

        /**
         * loads the required language files
         * @return array the loaded language-array
         * @throws FileNotFoundException
         */
        public function loadLanguage() {
            global $lang;

            $file = Config::$pathConfig['language'] . Config::$gameConfig['language'] . '/buildings.php';
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

        public static function build($planetID, $buildID, $toLvl, $metal, $crystal, $deuterium) {
            global $debug;

            // check if requirements are met
            $req_met = true;

            // check requirements
            if (D_Units::getRequirements($buildID) !== []) {


                $req = D_Units::getRequirements($buildID);

                foreach ($req as $bID => $lvl) {

                    if (!$req_met) {
                        break;
                    }

                    // if requirement is a building
                    if ($bID < 100) {
                        $level = Loader::getBuildingList()[$buildID]->getLevel();
                    }

                    // if requirement is a research
                    if ($bID > 100 && $bID < 200) {
                        $level = Loader::getTechList()[$buildID]->getLevel();
                    }

                    if ($level < $lvl) {
                        throw new InvalidArgumentException('Requirements not met');
                        break;
                    }

                }
            }

            if (Loader::getPlanet()->getBBuildingId() == 0 && Loader::getPlanet()->getBBuildingEndtime() == 0) {
                if ($buildID > 0 && $metal >= 0 && $crystal >= 0 && $deuterium >= 0) {
                    try {


                        $buildTime = time() + 3600 * D_Units::getBuildTime(
                                Loader::getBuildingList()[$buildID],
                                Loader::getBuildingList()[D_Units::getUnitID('robotic_factory')]->getLevel(),
                                Loader::getBuildingList()[D_Units::getUnitID('shipyard')]->getLevel(),
                                Loader::getBuildingList()[D_Units::getUnitID('nanite_factory')]->getLevel()
                            );


                        $params = array(':b_building_id'      => $buildID,
                                        ':b_building_endtime' => $buildTime,
                                        ':metal'              => $metal,
                                        ':crystal'            => $crystal,
                                        ':deuterium'          => $deuterium,
                                        ':planetID'           => $planetID
                        );

                        $dbConnection = new Database();

                        $stmt = $dbConnection->prepare('UPDATE ' . Config::$dbConfig['prefix'] . 'planets SET b_building_id = :b_building_id, b_building_endtime = :b_building_endtime, metal = :metal, crystal = :crystal, deuterium = :deuterium WHERE planetID = :planetID;');

                        $stmt->execute($params);
                    } catch (PDOException $e) {
                        if (DEBUG) {
                            $debug->addLog(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                        } else {
                            $debug->saveError(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                        }
                    }
                } else {
                    throw new InvalidArgumentException('Passed arguments are not valid');
                }
            } else {
                throw new UnexpectedFalueException('a building is already in the buildingqueue');
            }

        }

        public static function cancel($planetID, $metal, $crystal, $deuterium) {
            global $debug;

            $dbConnection = new Database();

            if (Loader::getPlanet()->getBBuildingId() > 0 && Loader::getPlanet()->getBBuildingEndtime() > 0) {
                if ($planetID > 0 && $metal >= 0 && $crystal >= 0 && $deuterium >= 0) {
                    try {

                        $params = array(':planetID'  => $planetID,
                                        ':metal'     => $metal,
                                        ':crystal'   => $crystal,
                                        ':deuterium' => $deuterium
                        );

                        $stmt = $dbConnection->prepare('UPDATE ' . Config::$dbConfig['prefix'] . 'planets SET b_building_id = 0, b_building_endtime = 0, metal = metal+:metal, crystal = crystal+:crystal, deuterium = deuterium+:deuterium WHERE planetID = :planetID;');

                        $stmt->execute($params);
                    } catch (PDOException $e) {
                        if (DEBUG) {
                            $debug->addLog(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                        } else {
                            $debug->saveError(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                        }
                    }
                } else {
                    throw new InvalidArgumentException('Passed arguments are not valid');
                }
            } else {
                throw new UnexpectedValueException('no building is currently in the buildingqueue');
            }
        }
    }
