<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    require $path['interfaces'] . 'controller.interface.php';

    class C_Galaxy implements I_Controller {

        private $get = null;

        private $post = null;

        private $lang = null;

        private $currentGalaxy;

        private $currentSystem;

        function __construct($get, $post) {

            global $debug;

            try {
                $this->get = $get;
                $this->post = $post;

                if (!empty($this->get)) {
                    self::handleGET();
                }

                if (!empty($post)) {
                    self::handlePOST();
                }


            } catch (Exception $e) {
                if (DEBUG) {
                    $debug->addLog(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                } else {
                    $debug->saveError(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                }
            }
        }

        function handleGET() : void {

            global $data;
            if (!empty($this->get['cp'])) {
                $data->getUser()->setCurrentPlanet(intval($this->get['cp']));
            }

            if (isset($this->get['g'])) {
                if (isset($this->get['s'])) {
                    $this->currentGalaxy = filter_input(INPUT_GET, 'g', FILTER_VALIDATE_INT);
                    $this->currentSystem = filter_input(INPUT_GET, 's', FILTER_VALIDATE_INT);

                    if (!isset($this->currentGalaxy) || $this->currentGalaxy == null) {
                        $this->currentGalaxy = 1;
                    }

                    if (!isset($this->currentSystem) || $this->currentSystem == null) {
                        $this->currentSystem = 1;
                    }

                    if ($this->currentGalaxy <= 0) {
                        $this->currentGalaxy = 1;
                    }

                    if ($this->currentSystem <= 0) {
                        $this->currentGalaxy = 1;
                    }
                }
            }
        }

        function handlePOST() : void {

        }

        function display() : void {

            global $config, $data;

            // load view
            $view = new V_Galaxy();

            // set the values for the topbar
            $this->lang['planet_galaxy'] = $data->getPlanet()->getGalaxy();
            $this->lang['planet_system'] = $data->getPlanet()->getSystem();
            $this->lang['planet_planet'] = $data->getPlanet()->getPlanet();
            $this->lang['planet_name'] = $data->getPlanet()->getName();
            $this->lang['planet_diameter'] = $data->getPlanet()->getDiameter();
            $this->lang['planet_fields_current'] = $data->getPlanet()->getFieldsCurrent();
            $this->lang['planet_fields_max'] = $data->getPlanet()->getFieldsMax();
            $this->lang['planet_temp_min'] = $data->getPlanet()->getTempMin();
            $this->lang['planet_temp_max'] = $data->getPlanet()->getTempMax();
            $this->lang['planet_metal'] = number_format($data->getPlanet()->getMetal(), 0);
            $this->lang['planet_crystal'] = number_format($data->getPlanet()->getCrystal(), 0);
            $this->lang['planet_deuterium'] = number_format($data->getPlanet()->getDeuterium(), 0);
            $this->lang['planet_energy_used'] = number_format($data->getPlanet()->getEnergyUsed(), 0);
            $this->lang['planet_energy_max'] = number_format($data->getPlanet()->getEnergyMax(), 0);
            $this->lang['planet_image_small'] = 'skins/Maya/planeten/small/s_' . $data->getPlanet()
                    ->getImage() . '.jpg';
            $this->lang['planet_image'] = 'skins/Maya/planeten/' . $data->getPlanet()->getImage() . '.jpg';
            $this->lang['icon_metal'] = 'skins/Maya/images/metal.gif';
            $this->lang['icon_crystal'] = 'skins/Maya/images/crystal.gif';
            $this->lang['icon_deuterium'] = 'skins/Maya/images/deuterium.gif';
            $this->lang['icon_energy'] = 'skins/Maya/images/energy.gif';
            $this->lang['basepath'] = $config['basepath'];

            $v_lang = M_Galaxy::loadLanguage();
            $galaxyData = M_Galaxy::loadGalaxyData($this->currentGalaxy, $this->currentSystem);

            // load the individual rows for each building
            $this->lang['galaxy_list'] = $view->loadGalaxyRows();

            if (is_array($this->lang) && is_array($v_lang)) {
                $this->lang = array_merge($this->lang, $v_lang);
            } else {
                if (!isset($this->lang) && empty($this->lang) && isset($v_lang) && !empty($v_lang)) {
                    $this->lang = $v_lang;
                }
            }


            $view->assign('lang', $this->lang);
            $view->assign('title', $config['game_name']);
            $view->assign('skinpath', $config['skinpath']);
            $view->assign('copyright', $config['copyright']);
            $view->assign('language', $config['language']);

            if (!empty($this->get['mode'])) {
                die($view->loadTemplate($this->get['mode']));
            } else {
                die($view->loadTemplate());
            }
        }
    }
