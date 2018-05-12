<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class V_Galaxy extends V_View implements I_View {

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

        public function loadGalaxyRows($galaxyData) {
            global $data;

            //            echo "<pre>";
            //            print_r($galaxyData);
            //            echo "</pre>";

            ob_start();

            $file = Config::$pathConfig['templates'] . $this->template . '_row.php';
            if (file_exists($file)) {
                include $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            $row = ob_get_contents();
            ob_end_clean();


            $output = "";

            for ($i = 1; $i <= 15; $i++) {

                $fields['galaxy_pos'] = $i;

                // if there is a planet at this position
                if (array_key_exists($i, $galaxyData)) {
                    $fields['galaxy_planetimg'] = "<img width='32px' height='32px' src=\"" . Config::$gameConfig['skinpath'] . "/planeten/small/s_" . $galaxyData[$i]->image . ".png\" />";


                    $fields['galaxy_name'] = $galaxyData[$i]->name;


                    if (intval($galaxyData[$i]->moonID) > 0) {
                        $fields['galaxy_moon'] = "<img width='32px' height='32px' src=\"" . Config::$gameConfig['skinpath'] . "/planeten/mond.png\" />";
                    } else {
                        $fields['galaxy_moon'] = "";
                    }


                    // TODO: mouse-over for more details
                    if ($galaxyData[$i]->debris_metal > 0 || $galaxyData[$i]->debris_crystal > 0) {
                        $fields['galaxy_debris'] = "<img src=\"" . Config::$gameConfig['skinpath'] . "/images/debris.png\" />";
                    } else {
                        $fields['galaxy_debris'] = "-";
                    }


                    $status = "";

                    $inactiveSince = time() - $galaxyData[$i]->onlinetime;

                    // TODO: vacation / banned
                    // 2 weeks or 1 week inactive?
                    if ($inactiveSince > 604800) {
                        $status .= '(<span class="inactive_long">I</span>)';
                    } else {
                        if ($inactiveSince > 302400) {
                            $status .= '(<span class="inactive_short">i</span>)';
                        }
                    }

                    if (strlen($galaxyData[$i]->username) > 10) {
                        $fields['galaxy_player'] = substr($galaxyData[$i]->username, 0, 10) . " ... " . $status;
                    } else {
                        $fields['galaxy_player'] = $galaxyData[$i]->username . " " . $status;
                    }

                    // TODO
                    $fields['galaxy_alliance'] = "-";


                    $fields['galaxy_actions'] = "";

                    // if it is the player himself
                    if (intval($galaxyData[$i]->userID) === $data->getUser()->getUserID()) {
                        $fields['galaxy_actions'] = " - ";
                    } else {

                        // if player has espionage-probes
                        if ($data->getFleet()[209]->getAmount() > 0) {
                            // TODO: create link
                            $fields['galaxy_actions'] .= "<img src=\"" . Config::$gameConfig['skinpath'] . "/images/e.gif\" />&nbsp;";
                        }

                        // TODO: create link
                        $fields['galaxy_actions'] .= "<img src=\"" . Config::$gameConfig['skinpath'] . "/images/m.gif\" />&nbsp;";

                        // TODO: if not already butty
                        $fields['galaxy_actions'] .= "<img src=\"" . Config::$gameConfig['skinpath'] . "/images/b.gif\" />&nbsp;";

                        // TODO: if in range
                        if ($data->getDefense()[310]->getAmount() > 0) {
                            $fields['galaxy_actions'] .= "<img src=\"" . Config::$gameConfig['skinpath'] . "/images/r.gif\" />";
                        }
                    }


                } else {
                    $fields['galaxy_planetimg'] = "";
                    $fields['galaxy_name'] = "";
                    $fields['galaxy_moon'] = "";
                    $fields['galaxy_debris'] = "";
                    $fields['galaxy_player'] = "";
                    $fields['galaxy_alliance'] = "";
                    $fields['galaxy_actions'] = "";
                }

                $temp = $row;

                foreach ($fields as $a => $b) {

                    //                    echo $a . " => " . $b . "<br />";

                    $temp = str_replace("{{$a}}", $b, $temp);
                }

                $output .= $temp;


            }

            return $output;
        }
    }

