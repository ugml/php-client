<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    require_once $path['interfaces'] . 'view.php';
    require_once $path['classes'] . 'view.php';

    class V_Research extends View implements I_View {

        private $template = 'research';

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

        public function loadResearchRows($research, $unitsResearch, $planet) {

            global $path, $config, $lang, $data;

            $output = '';

            foreach ($unitsResearch as $k => $v) {

                // the key of the current research
                $key = $data->getUnits()->getUnitID($v);

                //echo $key . " - " . $v . "<br />";

                $req_met = true;

                // check requirements
                if ($data->getUnits()->getRequirements($key) !== []) {

                    $req = $data->getUnits()->getRequirements($key);

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
                            $level = call_user_func_array(array($research, $method), array());
                            //echo $key . " need (research) lvl " . $lvl . " has " . $level . "<br />";
                        }

                        if ($level < $lvl) {
                            //echo " -> req not met <br />";
                            $req_met = false;
                        }

                    }
                }

                if ($req_met) {

                    $methodArr = explode('_', $v);

                    $method = 'get';

                    foreach ($methodArr as $a => $b) {
                        $method .= ucfirst($b);
                    }

                    $level = call_user_func_array(array($research, $method), array());

                    $unitID = $data->getUnits()->getUnitID($v);

                    $pricelist = $data->getUnits()->getPriceList($unitID);

                    $fields['r_name'] = $data->getUnits()->getName($unitID);
                    $fields['r_level'] = $level;
                    $fields['r_description'] = $data->getUnits()->getDescription($unitID);


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
                        $planet->getBTechId() == 0) {
                        $fields['r_build_class'] = 'buildable';
                        $buildable = true;
                    } else {
                        $fields['r_build_class'] = 'notBuildable';
                    }

                    if ($data->getPlanet()->getBTechId() > 0) {
                        if ($unitID == $data->getPlanet()->getBTechId()) {
                            $fields['r_build'] = '-<script>timer(' . ($data->getPlanet()
                                        ->getBTechEndtime() - time()) . ', "build_' . $unitID . '", ' . $unitID . ');</script>';
                        } else {
                            $fields['r_build'] = "-";
                        }
                    } else {
                        if ($level > 0) {
                            if ($buildable) {
                                $fields['r_build'] = '<a href="?page=research&build=' . $unitID . '"  class="' . $fields['r_build_class'] . '">' . str_replace("%s",
                                        ++$level, $lang['upgrade']) . '</a>';
                            } else {
                                $fields['r_build'] = '<span class="' . $fields['r_build_class'] . '">' . str_replace("%s",
                                        ++$level, $lang['upgrade']) . '</span>';
                            }
                        } else {
                            if ($buildable) {
                                $fields['r_build'] = '<a href="?page=research&build=' . $unitID . '"  class="' . $fields['r_build_class'] . '">' . $lang['build'] . '</a>';
                            } else {
                                $fields['r_build'] = '<span class="' . $fields['r_build_class'] . '">' . $lang['build'] . '</span>';
                            }
                        }
                    }

                    $fields['r_image'] = $config['skinpath'] . 'gebaeude/' . $unitID . '.png';
                    $fields['r_metal'] = number_format(ceil($metal), 0);
                    $fields['r_crystal'] = number_format(ceil($crystal), 0);
                    $fields['r_deuterium'] = number_format(ceil($deuterium), 0);


                    $duration = ($metal + $crystal) / (1000 * (1 + $data->getBuilding()->getResearchLab())) * 3600;

                    $hours = floor($duration / 3600);
                    $minutes = floor(($duration / 60) % 60);
                    $seconds = $duration % 60;

                    $fields['r_time'] = "";

                    if ($hours > 0) {
                        $fields['r_time'] .= $hours . "h ";
                    }

                    if ($minutes > 0) {
                        $fields['r_time'] .= $minutes . "m ";
                    }

                    $fields['r_time'] .= $seconds . "s";

                    $fields['r_id'] = $unitID;


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

