<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class V_Fleet extends V_View implements I_View {

        private $template = 'fleet';

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

            if ($mode != null) {
                $this->template .= '_' . $mode;
            }

            return parent::mergeTemplates($this->template, $this->_);
        }

        public function loadAvailableShipsRow($shipsAvailable) : string {

            $output = "";

            $first = true;

            foreach($shipsAvailable[0] as $key => $value) {
                // skip planet-ID
                if($first) {
                    $first = false;
                    continue;
                }

                if($value > 0) {
                    $output .= "<div class=\"row\">
                                <div class=\"col-md-4 text-center\">
                                    <div>". D_Units::getName(D_Units::getUnitID($key)) ."</div>
                                </div>
                                <div class=\"col-md-4 text-center\">
                                    <div>". number_format($value, 0) ."</div>
                                </div>
                                <div class=\"col-md-4 text-center\">
                                    <div><a href=\"javascript:void(0)\" onclick=\"return setMax(this);\">{max}</a> <input name='".$key."' type='number' value='0' max='{$value}'  /> </div>
                                </div>
                            </div>";
                }


            }

            return $output;
        }

        public function loadCurrentMissionRow($currentMissions) : string {

            $output = "";

            if(count($currentMissions) == 0) {
                return "<div class=\"row\">
                            <div class=\"col-md-1 text-center\">
                                <div>-</div>
                            </div>
                            <div class=\"col-md-2 text-center\">
                                <div>-</div>
                            </div>
                            <div class=\"col-md-2 text-center\">
                                <div>-</div>
                            </div>
                            <div class=\"col-md-1 text-center\">
                                <div>-</div>
                            </div>
                            <div class=\"col-md-1 text-center\">
                                <div>-</div>
                            </div>
                            <div class=\"col-md-2 text-center\">
                                <div>-</div>
                            </div>
                            <div class=\"col-md-2 text-center\">
                                <div>-</div>
                            </div>
                            <div class=\"col-md-1 text-center\">
                                <div>-</div>
                            </div>
                        </div>";
            }

            for($i = 0; $i < count($currentMissions); $i++) {

                    $output .= "<div class=\"row\">
                                    <div class=\"col-md-1 text-center\">
                                        <div>".($i+1)."</div>
                                    </div>
                                    <div class=\"col-md-2 text-center\">
                                        <div>". $currentMissions[$i]->mission ."</div>
                                    </div>
                                    <div class=\"col-md-2 text-center\">
                                        <div>". $currentMissions[$i]->fleetlist ."</div>
                                    </div>
                                    <div class=\"col-md-1 text-center\">
                                        <div>". $currentMissions[$i]->start_id ."</div>
                                    </div>
                                    <div class=\"col-md-2 text-center\">
                                        <div>". date("d.m.y h:m:s", $currentMissions[$i]->start_time) ."</div>
                                    </div>
                                    <div class=\"col-md-1 text-center\">
                                        <div>". $currentMissions[$i]->end_id ."</div>
                                    </div>
                                    <div class=\"col-md-2 text-center\">
                                        <div>". date("d.m.y h:m:s", $currentMissions[$i]->end_time) ."</div>
                                    </div>
                                    <div class=\"col-md-1 text-center\">
                                        <div>x</div>
                                    </div>
                                </div>";



            }


            return $output;
        }


    }

