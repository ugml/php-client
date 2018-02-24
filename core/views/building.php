<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class V_Building extends V_View implements I_View {

        private $template = 'buildings';

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

            global $path, $data;

            if ($mode != null) {
                $this->template .= '_' . $mode;
            }

            return parent::mergeTemplates($this->template, $this->_);
        }

        public function loadBuildingRows($buildings, $unitsBuilding, $planet) {

            global $path, $config, $lang, $data, $units;

            $output = '';

            foreach ($unitsBuilding as $k => $v) {

                $key = intval($k);

                $req_met = true;

                // check requirements
                if ($units->getRequirements($key) !== []) {

                    $req = $units->getRequirements($key);

                    foreach ($req as $bID => $lvl) {

                        if (!$req_met) {
                            break;
                        }

                        // if requirement is a building
                        if ($bID < 100) {
                            $level = ($data->getBuilding()[$bID])->getLevel();
                        }
                        // if requirement is a research
                        if ($bID > 100 && $bID < 200) {
                            $level = ($data->getTech()[$bID])->getLevel();
                        }

                        if ($level < $lvl) {
                            $req_met = false;
                        }

                    }
                }


                if ($req_met) {

                    $unitID = $units->getUnitID($v);

                    $level = $data->getBuilding()[$unitID]->getLevel();

                    $pricelist = $units->getPriceList($unitID);

                    $fields['b_name'] = $units->getName($unitID);
                    $fields['b_level'] = $level;
                    $fields['b_description'] = $units->getDescription($unitID);


                    //echo $fields['b_name'] . "<br/>";


                    // get the baseprice
                    $metal = $pricelist['metal'];
                    $crystal = $pricelist['crystal'];
                    $deuterium = $pricelist['deuterium'];

                    // calculate the total costs up to this level
                    for ($i = 0; $i < $level; $i++) {
                        $metal *= $pricelist['factor'];
                        $crystal *= $pricelist['factor'];
                        $deuterium *= $pricelist['factor'];
                    }


                    $buildable = false;

                    if ($planet->getMetal() >= $metal &&
                        $planet->getCrystal() >= $crystal &&
                        $planet->getDeuterium() >= $deuterium &&
                        $planet->getBBuildingId() == 0) {
                        $fields['b_build_class'] = 'buildable';
                        $buildable = true;
                    } else {
                        $fields['b_build_class'] = 'notBuildable';
                    }

                    if ($data->getPlanet()->getBBuildingId() > 0) {
                        if ($unitID == $data->getPlanet()->getBBuildingId()) {
                            $fields['b_build'] = '-<script>timer(' . ($data->getPlanet()
                                        ->getBBuildingEndtime() - time()) . ', "build_' . $unitID . '", ' . $unitID . ');</script>';
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

                    $fields['b_image'] = $config['skinpath'] . 'gebaeude/' . $unitID . '.png';
                    $fields['b_metal'] = number_format(ceil($metal), 0);
                    $fields['b_crystal'] = number_format(ceil($crystal), 0);
                    $fields['b_deuterium'] = number_format(ceil($deuterium), 0);

                    $duration = 3600 * $units->getBuildTime($unitID, ($level + 1),
                            $data->getBuilding()['robotic_factory'], $data->getBuilding()['shipyard'],
                            $data->getBuilding()['nanite_factory']);

                    $hours = floor($duration / 3600);
                    $minutes = floor(($duration / 60) % 60);
                    $seconds = $duration % 60;

                    $fields['b_time'] = "";

                    if ($hours > 0) {
                        $fields['b_time'] .= $hours . "h ";
                    }

                    if ($minutes > 0) {
                        $fields['b_time'] .= $minutes . "m ";
                    }

                    $fields['b_time'] .= $seconds . "s";

                    $fields['b_id'] = $unitID;


                    ob_start();

                    $file = $path['templates'] . $this->template . '_row.php';
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

