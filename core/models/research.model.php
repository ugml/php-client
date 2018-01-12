<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    require $path['interfaces'].'model.interface.php';

    class M_Research implements I_Model {

        /**
         * loads the required language files
         * @return array the loaded language-array
         * @throws FileNotFoundException
         */
        public static function loadLanguage() {
            global $path, $config, $lang;

            $file = $path['language'] . $config['language'] . '/research.language.php';
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

        public static function build($planetID, $buildID, $toLvl, $metal, $crystal, $deuterium) {
            global $database, $db, $data;

            //echo $key . " - " . $v . "<br />";

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
                        //echo $key . " need (building) lvl " . $lvl . " has " . $level . "<br />";
                    }

                    // if requirement is a research
                    if ($bID > 100 && $bID < 200) {
                        $level = call_user_func_array(array($data->getTech(), $method), array());
                        //echo $key . " need (research) lvl " . $lvl . " has " . $level . "<br />";
                    }

                    if ($level < $lvl) {
                        throw new InvalidArgumentException('Requirements not met');
                        break;
                    }

                }
            }

            if($data->getPlanet()->getBTechID() == 0 && $data->getPlanet()->getBTechEndtime() == 0) {
                if($buildID > 0 && $metal >= 0 && $crystal >= 0 && $deuterium >= 0) {
                    try {
                        
                        $price = $data->getUnits()->getPriceList($buildID);
                        
                        
                        // preis * faktor ^ level
                        
                        $buildTime = time() + ($price["metal"] * pow($price["factor"],$toLvl-1) + $price["crystal"] * pow($price["factor"],$toLvl-1))/(1000 * (1 + $data->getBuilding()->getResearchLab()))*3600;

                        $params = array(':b_tech_id' => $buildID,
                            ':b_tech_endtime' => $buildTime,
                            ':metal' => $metal,
                            ':crystal' => $crystal,
                            ':deuterium' => $deuterium,
                            ':planetID' => $planetID
                        );

                        $stmt = $db->prepare('UPDATE ' . $database['prefix'] . 'planets SET b_tech_id = :b_tech_id, b_tech_endtime = :b_tech_endtime, metal = :metal, crystal = :crystal, deuterium = :deuterium WHERE planetID = :planetID;');

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

            if($data->getPlanet()->getBTechID() > 0 && $data->getPlanet()->getBTechEndtime() > 0) {
                if($planetID > 0 && $metal >= 0 && $crystal >= 0 && $deuterium >= 0) {
                    try {

                        $params = array(':planetID' => $planetID,
                            ':metal' => $metal,
                            ':crystal' => $crystal,
                            ':deuterium' => $deuterium
                        );

                        $stmt = $db->prepare('UPDATE ' . $database['prefix'] . 'planets SET b_tech_id = 0, b_tech_endtime = 0, metal = metal+:metal, crystal = crystal+:crystal, deuterium = deuterium+:deuterium WHERE planetID = :planetID;');

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
