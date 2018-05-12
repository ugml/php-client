<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class C_Galaxy implements I_Controller {

        private $get = null;

        private $post = null;

        private $lang = null;

        private $model = null;
        private $view = null;


        private $currentGalaxy;

        private $currentSystem;

        function __construct($get, $post) {

            global $data, $units, $debug;

            try {

                $this->model = new M_Galaxy();
                $this->view = new V_Galaxy();

                $this->get = $get;
                $this->post = $post;

                if (!empty($this->get)) {
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
            print_r($this->post);
            echo "<h1>ASDASD</h1>";
        }

        function display() : void {

            global $data;

            $v_lang = $this->model->loadLanguage();
            $galaxyData = $this->model->loadGalaxyData($this->currentGalaxy, $this->currentSystem);

            // load the individual rows for each building
            $this->lang['galaxy_list'] = $this->view->loadGalaxyRows($galaxyData);

            // check boundaries
            if($this->currentGalaxy <= 1) {
                $this->currentGalaxy = 1;
                $this->lang['galaxy_pos_g_prev'] = 1;
            } else {
                $this->lang['galaxy_pos_g_prev'] = $this->currentGalaxy-1;
            }

            // check boundaries
            if($this->currentGalaxy >= Config::$gameConfig['max_galaxy']) {
                $this->currentGalaxy = Config::$gameConfig['max_galaxy'];
                $this->lang['galaxy_pos_g_next'] = Config::$gameConfig['max_galaxy'];
            } else {
                $this->lang['galaxy_pos_g_next'] = $this->currentGalaxy+1;
            }

            // check boundaries
            if($this->currentSystem <= 1) {
                $this->currentSystem = 1;
                $this->lang['galaxy_pos_s_prev'] = 1;
            } else {
                $this->lang['galaxy_pos_s_prev'] = $this->currentSystem-1;
            }

            // check boundaries
            if($this->currentSystem >= Config::$gameConfig['max_system']) {
                $this->currentSystem = Config::$gameConfig['max_system'];
                $this->lang['galaxy_pos_s_next'] = Config::$gameConfig['max_system'];
            } else {
                $this->lang['galaxy_pos_s_next'] = $this->currentSystem+1;
            }


            $this->lang['galaxy_pos_g'] = $this->currentGalaxy;
            $this->lang['galaxy_pos_s'] = $this->currentSystem;

            $this->lang['galaxy_num_planets'] = count($galaxyData);

            if (is_array($this->lang) && is_array($v_lang)) {
                $this->lang = array_merge($this->lang, $v_lang);
            } else {
                if (!isset($this->lang) && empty($this->lang) && isset($v_lang) && !empty($v_lang)) {
                    $this->lang = $v_lang;
                }
            }


            $this->view->assign('lang', $this->lang);
            $this->view->assign('title', Config::$gameConfig['game_name']);
            $this->view->assign('skinpath',Config::$gameConfig['skinpath']);
            $this->view->assign('copyright', Config::$gameConfig['copyright']);
            $this->view->assign('language', Config::$pathConfig['language']);

            if (!empty($this->get['mode'])) {
                echo $this->view->loadTemplate($this->get['mode']);
            } else {
                echo $this->view->loadTemplate();
            }
        }
    }
