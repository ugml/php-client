<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class V_Building extends V_View implements I_View {

        private $template = 'buildings';

        private $_ = array();

        /**
         * assigns the variables for the view
         *
         * @param String $key   the key
         * @param String $value the value
         */
        public function assign($key, $value) {

            $this->_[$key] = $value;
        }

        /**
         * sets the name of the template which will be used
         *
         * @param String $template name of the template
         */
        public function setTemplate($template) {

            $this->template = $template;
        }

        /**
         * loads the template file
         *
         * @param string $mode the subtemplate (e.g. resources_row.php)
         * @return string the template
         * @throws FileNotFoundException
         */
        public function loadTemplate($mode = null) {

            if ($mode != null) {
                $this->template .= '_' . $mode;
            }

            return parent::mergeTemplates($this->template, $this->_);
        }

        /**
         * loads each individual building-row
         *
         * @param $buildings     array the building-data of the planet
         * @param $unitsBuilding array the data of the units
         * @param $planet        planet the planet
         * @return string the complete list of buildingrows
         * @throws FileNotFoundException
         */
        public function loadBuildingRows($buildings, $unitsBuilding, $planet) {

            global $lang;

            $output = '';

            // foreach building
            foreach ($unitsBuilding as $k => $v) {

                $key = intval($k);

                $req_met = true;

                // check requirements
                if (D_Units::getRequirements($key) !== []) {

                    $req = D_Units::getRequirements($key);

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
                            $level = (Loader::getTechList()[$bID])->getLevel();
                        }

                        if ($level < $lvl) {
                            $req_met = false;
                        }

                    }
                }


                if ($req_met) {

                    $unitID = D_Units::getUnitID($v);

                    $building = Loader::getBuildingList()[$unitID];

                    $level = $building->getLevel();

                    $fields['b_name'] = D_Units::getName($unitID);
                    $fields['b_level'] = $level;
                    $fields['b_description'] = D_Units::getDescription($unitID);

                    $buildable = false;

                    // check if building is buildable and set the button accordingly
                    if ($planet->getMetal() >= $building->getCostMetal() &&
                        $planet->getCrystal() >= $building->getCostCrystal() &&
                        $planet->getDeuterium() >= $building->getCostDeuterium() &&
                        $planet->getBBuildingId() == 0) {
                        $fields['b_build_class'] = 'buildable';
                        $buildable = true;
                    } else {
                        $fields['b_build_class'] = 'notBuildable';
                    }

                    if (Loader::getPlanet()->getBBuildingId() > 0) {
                        if ($unitID == Loader::getPlanet()->getBBuildingId()) {
                            $fields['b_build'] = '-<script>timer("building", ' . (Loader::getPlanet()
                                        ->getBBuildingEndtime() - time()) . ', "build_' . $unitID . '", ' . $unitID . ', "{cancel}");</script>';
                        } else {
                            $fields['b_build'] = "-";
                        }
                    } else {
                        if ($level > 0) {
                            if ($buildable) {
                                $fields['b_build'] = '<a href="?page=building&build=' . $unitID . '"  class="' . $fields['b_build_class'] . '">' . str_replace("%s",
                                        ++$level, $lang['upgrade']) . '</a>';
                            } else {
                                $fields['b_build'] = '<span class="' . $fields['b_build_class'] . '">' . str_replace("%s",
                                        ++$level, $lang['upgrade']) . '</span>';
                            }
                        } else {
                            if ($buildable) {
                                $fields['b_build'] = '<a href="?page=building&build=' . $unitID . '"  class="' . $fields['b_build_class'] . '">' . $lang['build'] . '</a>';
                            } else {
                                $fields['b_build'] = '<span class="' . $fields['b_build_class'] . '">' . $lang['build'] . '</span>';
                            }
                        }
                    }

                    $fields['b_image'] = Config::$gameConfig['skinpath'] . 'gebaeude/' . $unitID . '.png';

                    $fields['required_ressources'] = '';

                    if ($building->getCostMetal() > 0) {
                        $fields['required_ressources'] .= '<img src="' . Config::$gameConfig['skinpath'] . '/images/metal.png"> ' . number_format($building->getCostMetal(),
                                0) . ' ';
                    }

                    if ($building->getCostCrystal() > 0) {
                        $fields['required_ressources'] .= '<img src="' . Config::$gameConfig['skinpath'] . '/images/crystal.png"> ' . number_format($building->getCostCrystal(),
                                0) . ' ';
                    }

                    if ($building->getCostDeuterium() > 0) {
                        $fields['required_ressources'] .= '<img src="' . Config::$gameConfig['skinpath'] . '/images/deuterium.png"> ' . number_format($building->getCostDeuterium(),
                                0) . ' ';
                    }

                    if ($building->getCostEnergy() > 0) {
                        $fields['required_ressources'] .= '<img src="' . Config::$gameConfig['skinpath'] . '/images/energy.png"> ' . number_format($building->getCostEnergy(),
                                0) . ' ';
                    }


                    $duration = 3600 * D_Units::getBuildTime($building, Loader::getBuildingList()[6]->getLevel(),
                            Loader::getBuildingList()[8]->getLevel(), Loader::getBuildingList()[7]->getLevel());


                    $weeks = floor(($duration / 604800));
                    $days = floor(($duration / 86400) % 7);
                    $hours = floor(($duration / 3600) % 24);
                    $minutes = floor(($duration / 60) % 60);
                    $seconds = $duration % 60;

                    $fields['b_time'] = "";

                    if ($weeks > 0) {
                        $fields['b_time'] .= $weeks . $lang['weeks_short'] . " ";
                    }

                    if ($days > 0) {
                        $fields['b_time'] .= $days . $lang['days_short'] . " ";
                    }

                    if ($hours > 0) {
                        $fields['b_time'] .= $hours . $lang['hours_short'] . " ";
                    }

                    if ($minutes > 0) {
                        $fields['b_time'] .= $minutes . $lang['minutes_short'] . " ";
                    }

                    $fields['b_time'] .= $seconds . $lang['seconds_short'] . " ";

                    $fields['b_id'] = $unitID;


                    ob_start();

                    $file = Config::$pathConfig['templates'] . $this->template . '_row.php';
                    if (file_exists($file)) {
                        include $file;
                    } else {
                        throw new FileNotFoundException('File \'' . $file . '\' not found');
                    }

                    $row = ob_get_contents();
                    ob_end_clean();

                    foreach ($fields as $a => $b) {
                        $row = str_replace("{{$a}}", $b, $row);
                    }

                    $output .= $row;
                }
            }


            return $output;
        }
    }

