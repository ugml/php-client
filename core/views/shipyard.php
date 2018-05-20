<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class V_Shipyard extends V_View implements I_View {

        private $template = 'shipyard';

        private $_ = array();

        /**
         * assigns the variables for the view
         *
         * @param String $key   Schlüssel
         * @param String $value Variable
         */
        public function assign($key, $value) {

            $this->_[$key] = $value;
        }

        /**
         * sets the name of the template which will be used
         *
         * @param String $template Name des Templates.
         */
        public function setTemplate($template) {

            $this->template = $template;
        }

        /**
         * this loads the template file
         *
         * @param string $mode the subtemplate (e.g. resources_row.php)
         * @return string the template
         * @throws FileNotFoundException
         */
        public function loadTemplate($mode = null) {

            // if(Loader::getPlanet()->getBBuildingId() > 0) {
            //     //duration, container, buildingID
            //     $this->_['lang']['cnt_script'] = '<script>(function() {timer('. (Loader::getPlanet()->getBBuildingEndtime()-time()) .', document.getElementById("s_'. Loader::getPlanet()->getBBuildingId() .'"),'. Loader::getPlanet()->getBBuildingId() .');})();</script>';
            // } else {
            //     $fields['cnt_script'] = '';
            // }

            $this->_['lang']['queue'] = "";

            if(Loader::getPlanet()->getBHangarStartTime() > 0) {


                $this->_['lang']['queue'] = "<div class=\"col-md-12\">
                                                <div class=\"row\">
                                                        <div class=\"col-md-12 content-header\">
                                                             ". $this->_['lang']["queue_heading"] ."
                                                        </div>
                                                        <div class=\"col-md-12 content-body\">
                                                            <div class=\"row\">
                                                                <div class=\"col-md-12 text-center\">
                                                                    <div>
                                                                        {currently_building} <span id=\"shipyard_timeleft\"></span> <br /><br />
                                                                        ". $this->_['lang']["queue_current"] .":<br />
                                                                        <select size=\"5\" id='shipyard_queue'>
                                                                            {current_queue}
                                                                        </select> <br />
                                                                        ". $this->_['lang']["queue_total_time_left"] .": <span id=\"shipyard_total_timeleft\"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class=\"col-md-12\">&nbsp;</div>";


                $queue = explode(";", Loader::getPlanet()->getBHangarId());

                $totalTimeLeft = 0;
                $timeLeftForCurrentUnit = 0;

                $first = true;

                foreach ($queue as$value) {

                    if(strlen($value) > 0) {

                        $data = explode(",", $value);

                        $unitID = $data[0];
                        $amount = $data[1];

                        // current time left
                        // time for one unit
                        // {buildingname => count}

                        $durationForOneUnit = 3600 * D_Units::getBuildTime(Loader::getFleetList()[$unitID],
                                Loader::getBuildingList()[6]->getLevel(), Loader::getBuildingList()[8]->getLevel(),
                                Loader::getBuildingList()[7]->getLevel());

                        $totalTimeLeft += $durationForOneUnit * $amount;

                        $timeLeftForCurrentUnit = $durationForOneUnit - (time() - Loader::getPlanet()->getBHangarStartTime());

                        if($first) {
                            $this->_['lang']['currently_building'] = D_Units::getName($unitID);
                            $this->_['lang']['current_time_left'] = floor($timeLeftForCurrentUnit);

                            $this->_['lang']['queue_script'] = "<script>timer(".$timeLeftForCurrentUnit.", ".$durationForOneUnit.", {total_time_left}, ".$amount.", '" .D_Units::getName($unitID) ."', \"shipyard\")</script>";

                            $first = false;
                        }

                        $this->_['lang']['current_queue'] .= "<option>" . $amount . " " . D_Units::getName($unitID) . "</option>\n";
                    }
                }


                $this->_['lang']['total_time_left'] = round($totalTimeLeft - (time() - Loader::getPlanet()->getBHangarStartTime()));

            }


            if ($mode != null) {
                $this->template .= '_' . $mode;
            }

            return parent::mergeTemplates($this->template, $this->_);
        }

        public function loadShipyardRows() {

            global $lang;

            $output = '';

            $unitsBuilding = D_Units::getFleet();

            $planet = Loader::getPlanet();

            foreach ($unitsBuilding as $k => $v) {

                // the key of the current research
                $key = D_Units::getUnitID($v);

                $req_met = true;

                // check requirements
                if (D_Units::getRequirements($key) !== []) {

                    $req = D_Units::getRequirements($key);

                    foreach ($req as $bID => $lvl) {

                        // if requirements are not met, exit the loop
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

                    $fleet = Loader::getFleetList()[$unitID];

                    $level = $fleet->getAmount();

                    $fields['s_name'] = D_Units::getName($unitID);
                    $fields['s_level'] = $level;
                    $fields['s_description'] = D_Units::getDescription($unitID);


                    // get the price
                    $metal = $fleet->getCostMetal();
                    $crystal = $fleet->getCostCrystal();
                    $deuterium = $fleet->getCostDeuterium();

                    if ($planet->getMetal() >= $metal &&
                        $planet->getCrystal() >= $crystal &&
                        $planet->getDeuterium() >= $deuterium &&
                        $planet->getBBuildingId() == 0) {
                        $fields['s_build_class'] = 'buildable';
                        $fields['s_disabled'] = '';
                    } else {
                        $fields['s_build_class'] = 'notbuildable';
                        $fields['s_disabled'] = 'disabled';
                    }

                    $fields['s_image'] = Config::$gameConfig['skinpath'] . 'gebaeude/' . $unitID . '.png';
                    $fields['s_metal'] = number_format(ceil($metal), 0);
                    $fields['s_crystal'] = number_format(ceil($crystal), 0);
                    $fields['s_deuterium'] = number_format(ceil($deuterium), 0);


                    $duration = 3600 * D_Units::getBuildTime($fleet, 0,
                            Loader::getBuildingList()[D_Units::getUnitID('shipyard')]->getLevel(),
                            Loader::getBuildingList()[D_Units::getUnitID('nanite_factory')]->getLevel());

                    $hours = floor($duration / 3600);
                    $minutes = floor(($duration / 60) % 60);
                    $seconds = $duration % 60;


                    $fields['s_time'] = "";

                    if ($hours > 0) {
                        $fields['s_time'] .= $hours . "h ";
                    }

                    if ($minutes > 0) {
                        $fields['s_time'] .= $minutes . "m ";
                    }

                    $fields['s_time'] .= $seconds . "s";

                    $fields['s_id'] = $unitID;


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

            if ($output === '') {
                $output .= '<div class="row"><div class="col-md-12"><div>' . $lang['no_fleet_available'] . '</div></div></div>';
            }

            return $output;
        }
    }

