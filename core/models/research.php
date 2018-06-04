<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class M_Research implements I_Model {

        public static function build($planetID, $buildID, $toLvl, $metal, $crystal, $deuterium) {
            global $debug;

            $dbConnection = new Database();

            //echo $key . " - " . $v . "<br />";

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
                        $level = (Loader::getBuildingList()[$bID])->getLevel();
                    }

                    // if requirement is a research
                    if ($bID > 100 && $bID < 200) {
                        $level = Loader::getTechList()[$bID]->getLevel();
                    }

                    if ($level < $lvl) {
                        throw new InvalidArgumentException('Requirements not met');
                        break;
                    }

                }
            }

            if (Loader::getPlanet()->getBTechID() == 0 && Loader::getPlanet()->getBTechEndtime() == 0) {
                if ($buildID > 0 && $metal >= 0 && $crystal >= 0 && $deuterium >= 0) {
                    try {

                        $price = D_Units::getPriceList($buildID);


                        // preis * faktor ^ level

                        $buildTime = time() + ($price["metal"] * pow($price["factor"],
                                    $toLvl - 1) + $price["crystal"] * pow($price["factor"],
                                    $toLvl - 1)) / (1000 * (1 + Loader::getBuildingList()['research_lab'])) * 3600;

                        $params = array(':b_tech_id'      => $buildID,
                                        ':b_tech_endtime' => $buildTime,
                                        ':metal'          => $metal,
                                        ':crystal'        => $crystal,
                                        ':deuterium'      => $deuterium,
                                        ':planetID'       => $planetID
                        );

                        $stmt = $dbConnection->prepare('UPDATE planets SET b_tech_id = :b_tech_id, b_tech_endtime = :b_tech_endtime, metal = :metal, crystal = :crystal, deuterium = :deuterium WHERE planetID = :planetID;');

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
                throw new UnexpectedValueException('a building is already in the buildingqueue');
            }

        }

        public static function cancel($planetID, $metal, $crystal, $deuterium) {
            global $debug;

            $dbConnection = new Database();

            if (Loader::getPlanet()->getBTechID() > 0 && Loader::getPlanet()->getBTechEndtime() > 0) {
                if ($planetID > 0 && $metal >= 0 && $crystal >= 0 && $deuterium >= 0) {
                    try {

                        $params = array(':planetID'  => $planetID,
                                        ':metal'     => $metal,
                                        ':crystal'   => $crystal,
                                        ':deuterium' => $deuterium
                        );

                        $stmt = $dbConnection->prepare('UPDATE planets SET b_tech_id = 0, b_tech_endtime = 0, metal = metal+:metal, crystal = crystal+:crystal, deuterium = deuterium+:deuterium WHERE planetID = :planetID;');

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

        /**
         * loads the required language files
         * @return array the loaded language-array
         * @throws FileNotFoundException
         */
        public function loadLanguage() {

            global $lang;

            $file = Config::$pathConfig['language'] . Config::$gameConfig['language'] . '/research.php';
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
