<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    require $path['interfaces'] . 'view.interface.php';

    class V_Galaxy extends View implements I_View {

        private $template = 'galaxy';

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

            if ($mode != null) {
                $this->template .= '_' . $mode;
            }

            return parent::mergeTemplates($this->template, $this->_);
        }

        public function loadGalaxyRows() {

            //            global $path, $config, $lang, $data;
            //
            //            $output = '';
            //
            //            foreach($unitsBuilding as $k => $v ) {
            //                $methodArr = explode('_', $v);
            //
            //                $method = 'get';
            //
            //                foreach($methodArr as $a => $b) {
            //                    $method .= ucfirst($b);
            //                }
            //
            //                $level = call_user_func_array(array($buildings, $method), array());
            //
            //
            //                $unitID = $data->getUnits()->getUnitID($v);
            //
            //
            //                $pricelist = $data->getUnits()->getPriceList($unitID);
            //
            //                $fields['b_name'] = $data->getUnits()->getName($unitID);
            //                $fields['b_level'] = $level;
            //                $fields['b_description'] = $data->getUnits()->getDescription($unitID);
            //
            //                if($level > 0) {
            //                    $fields['b_build'] = str_replace("%s", ++$level, $lang['upgrade']);
            //                } else {
            //                    $fields['b_build'] = $lang['build'];
            //                }
            //
            //
            //                // get the baseprice
            //                $metal = $pricelist['metal'];
            //                $crystal = $pricelist['crystal'];
            //                $deuterium = $pricelist['deuterium'];
            //
            //                // calculate the total costs up to this level
            //                for($i = 0; $i < $level; $i++) {
            //                    $metal *= $pricelist['factor'];
            //                    $crystal *= $pricelist['factor'];
            //                    $deuterium *= $pricelist['factor'];
            //                }
            //
            //                if($planet->getMetal() >= $metal &&
            //                    $planet->getCrystal() >= $crystal &&
            //                    $planet->getDeuterium() >= $deuterium &&
            //                    $planet->getBBuildingId() == 0) {
            //                    $fields['b_build_class'] = 'buildable';
            //                    $fields['b_disabled'] = '';
            //                } else {
            //                    $fields['b_build_class'] = 'notbuildable';
            //                    $fields['b_disabled'] = 'disabled';
            //                }
            //
            //                $fields['b_image'] = $config['skinpath'] . 'gebaeude/'. $unitID .'.gif';
            //                $fields['b_metal'] = number_format(ceil($metal),0);
            //                $fields['b_crystal'] = number_format(ceil($crystal),0);
            //                $fields['b_deuterium'] = number_format(ceil($deuterium),0);
            //                $fields['b_time'] = 3600 * $data->getUnits()->getBuildTime($unitID,($level+1),$data->getBuilding()->getRoboticFactory(), $data->getBuilding()->getNaniteFactory());
            //                $fields['b_id'] = $unitID;
            //
            //
            //                ob_start();
            //
            //            $file = $path['templates'] . $this->template . '_row.template.php';
            //            if (file_exists($file)) {
            //                include $file;
            //            } else {
            //                throw new FileNotFoundException('File \'' . $file . '\' not found');
            //            }
            //
            //            $row = ob_get_contents();
            //            ob_end_clean();
            //
            //                foreach ($fields as $a => $b) {
            //                    $row = str_replace("{{$a}}", $b, $row);
            //                }
            //
            //                $output .= $row;
            //            }

            return $output;
        }
    }

