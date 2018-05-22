<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class C_Fleet implements I_Controller {

        private $get = null;

        private $post = null;

        private $lang = null;

        private $model = null;

        private $view = null;

        private $fleetData = null;

        private $step = null;

        function __construct($get, $post) {

            global $debug;

            try {

                $this->model = new M_Fleet();
                $this->view = new V_Fleet();

                $this->get = $get;
                $this->post = $post;

                $this->fleetData = [];

                if (!empty($get)) {
                    self::handleGET();
                }

                if (!empty($post)) {
                    self::handlePOST();
                }

                require_once(Config::$pathConfig['classes'] . "topbar.php");


            } catch (Exception $e) {
                if (DEBUG) {
                    $debug->addLog(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                } else {
                    $debug->saveError(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                }
            }
        }

        function handleGET() : void {

            if (!empty($this->get['cp'])) {
                Loader::getUser()->setCurrentPlanet(intval($this->get['cp']));
            }


        }

        function handlePOST() : void {

            if(isset($this->post['step'])) {
                $this->step = intval($this->post['step']);
                unset($this->post['step']);
            } else {
                return;
            }

            // if the post was made from the ship-selection screen
            if($this->step == 1) {

                // if some ships have been posted
                foreach($this->post as $key => $value) {

                    // validate
                    if(intval($value) > 0) {
                        if (D_Units::getUnitID($key) > 0) {
                            $this->lang["fleet_fleetdata"] .= D_Units::getUnitID($key) . "," . $value . ";";
                        } else {
                            throw new InvalidArgumentException("invalid unit");
                        }
                    }
                }
            }

            // if the post was made from the destination-selection screen
            if($this->step == 2) {

                // check destination
                if(!ctype_digit($this->post['fleet_dest_galaxy']) ||
                    !ctype_digit($this->post['fleet_dest_system']) ||
                    !ctype_digit($this->post['fleet_dest_planet'])) {
                    throw new InvalidArgumentException("invalid destination");
                }

                // check destination type
                if(!ctype_digit($this->post['fleet_dest_type']) ||
                    intval($this->post['fleet_dest_type']) < 0 ||
                    intval($this->post['fleet_dest_type']) > 2) {
                    throw new InvalidArgumentException("invalid destination type");
                }

                // check speed
                if(!ctype_digit($this->post['fleet_speed']) ||
                    intval($this->post['fleet_speed']) % 10 != 0) {
                    throw new InvalidArgumentException("invalid speed");
                }


                $fleetDataString = explode(";", $this->post["fleet_fleetdata"]);


                $fleetData = [];

                foreach($fleetDataString as $unit) {
                    if(strlen($unit) == 0) {
                        continue;
                    }

                    $data = explode(",", $unit);

                    if(ctype_digit($data[0]) && ctype_digit($data[1])) {
                        $unitID = $data[0];
                        $amount = $data[1];

                        // if the posted amount is bigger then the user has ships on his planet
                        if(Loader::getFleetData()->getFleetByID(intval($unitID)) < $amount) {
                            $amount = Loader::getFleetData()->getFleetByID(intval($unitID));
                        }
                    } else {
                        throw new InvalidArgumentException("invalid fleetdata");
                    }

                    $fleetData[intval($unitID)] = intval($amount);
                }

                if(count($fleetData) == 0) {
                    throw new InvalidArgumentException("invalid fleetdata");
                }

                $dest_galaxy = intval($this->post["fleet_dest_galaxy"]);
                $dest_system = intval($this->post["fleet_dest_system"]);
                $dest_planet = intval($this->post["fleet_dest_planet"]);
                $dest_type = intval($this->post["fleet_dest_type"]);

                $fleet_metal = intval($this->post["fleet_metal"]);
                $fleet_crystal = intval($this->post["fleet_crystal"]);
                $fleet_deuterium = intval($this->post["fleet_deuterium"]);

                // TODO: check storage of ships!
                // TODO: check, if enough ressources are available on the planet!

                if($fleet_metal > Loader::getPlanet()->getMetal()) {
                    $fleet_metal = Loader::getPlanet()->getMetal();
                }

                if($fleet_crystal > Loader::getPlanet()->getCrystal()) {
                    $fleet_crystal = Loader::getPlanet()->getCrystal();
                }

                if($fleet_deuterium > Loader::getPlanet()->getDeuterium()) {
                    $fleet_deuterium = Loader::getPlanet()->getDeuterium();
                }


                $this->model->sendFleet($dest_galaxy, $dest_system, $dest_planet, $dest_type, $fleet_metal, $fleet_crystal, $fleet_deuterium, $fleetData);

            }

        }

        function display() : void {

            $v_lang = $this->model->loadLanguage();

            if($this->step == 0) {
                $currentMissions = $this->model->loadCurrentMissions();

                $this->lang['fleet_current_missions'] = $this->view->loadCurrentMissionRow($currentMissions);

                $availableShips = $this->model->loadAvailableShips();

                $this->lang['fleet_available_list'] = $this->view->loadAvailableShipsRow($availableShips);

            }



            if (is_array($this->lang) && is_array($v_lang)) {
                $this->lang = array_merge($this->lang, $v_lang);
            } else {
                if (!isset($this->lang) && empty($this->lang) && isset($v_lang) && !empty($v_lang)) {
                    $this->lang = $v_lang;
                }
            }

            $this->view->assign('lang', $this->lang);


            switch($this->step) {
                case 1:
                    echo $this->view->loadTemplate("set_destination");
                    break;
                case 2:
                    echo $this->view->loadTemplate("sent");
                    break;
                default:
                    echo $this->view->loadTemplate();
                    break;
            }



        }
    }
