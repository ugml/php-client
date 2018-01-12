<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    require $path['interfaces'] . 'view.interface.php';

    class V_Shipyard extends View implements I_View {

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
         * @param string $mode the subtemplate (e.g. resources_row.template.php)
         * @return string the template
         * @throws FileNotFoundException
         */
        public function loadTemplate($mode = null) {

            global $data;

            // if($data->getPlanet()->getBBuildingId() > 0) {
            //     //duration, container, buildingID
            //     $this->_['lang']['cnt_script'] = '<script>(function() {timer('. ($data->getPlanet()->getBBuildingEndtime()-time()) .', document.getElementById("s_'. $data->getPlanet()->getBBuildingId() .'"),'. $data->getPlanet()->getBBuildingId() .');})();</script>';
            // } else {
            //     $fields['cnt_script'] = '';
            // }

            if ($mode != null) {
                $this->template .= '_' . $mode;
            }

            return parent::mergeTemplates($this->template, $this->_);
        }

        public function loadShipyardRows($buildings, $unitsBuilding, $planet) {

            global $path, $config, $lang, $data;

            $output = '';

            foreach ($unitsBuilding as $k => $v) {
                $methodArr = explode('_', $v);

                $method = 'get';

                foreach ($methodArr as $a => $b) {
                    $method .= ucfirst($b);
                }

                $level = call_user_func_array(array($buildings, $method), array());


                $unitID = $data->getUnits()->getUnitID($v);


                $pricelist = $data->getUnits()->getPriceList($unitID);

                $fields['s_name'] = $data->getUnits()->getName($unitID);
                $fields['s_level'] = $level;
                $fields['s_description'] = $data->getUnits()->getDescription($unitID);


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

                $fields['s_image'] = $config['skinpath'] . 'gebaeude/' . $unitID . '.png';
                $fields['s_metal'] = number_format(ceil($metal), 0);
                $fields['s_crystal'] = number_format(ceil($crystal), 0);
                $fields['s_deuterium'] = number_format(ceil($deuterium), 0);

                $duration = 3600 * $data->getUnits()
                        ->getBuildTime($unitID, 0, $data->getBuilding()->getRoboticFactory(),
                            $data->getBuilding()->getShipyard(), $data->getBuilding()->getNaniteFactory());

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

                $file = $path['templates'] . $this->template . '_row.template.php';
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

            return $output;
        }
    }

