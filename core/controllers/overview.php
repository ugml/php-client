<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    require $path['interfaces'] . 'controller.php';

    class C_Overview implements I_Controller {

        private $get = null;

        private $post = null;

        private $lang = null;

        /**
         * C_Overview constructor.
         * @param $get
         * @param $post
         */
        function __construct($get, $post) {

            global $data, $debug, $path;

            try {
                $this->get = $get;
                $this->post = $post;

                if (!empty($this->get)) {
                    self::handleGET();
                }

                if (!empty($post)) {
                    self::handlePOST();
                }

                require_once($path['classes'] . "topbar.php");


                if (!empty($this->get['mode'])) {
                    switch ($this->get['mode']) {
                        case 'renameplanet':
                            $this->lang['planet_id'] = $data->getUser()->getCurrentPlanet();
                            break;
                    }
                } else {
                    $this->lang['galaxy_metal'] = number_format($data->getGalaxy()->getDebrisMetal(), 0);
                    $this->lang['galaxy_crystal'] = number_format($data->getGalaxy()->getDebrisCrystal(), 0);
                    $this->lang['time'] = time();
                }

                // currently building?
                if ($data->getPlanet()->getBBuildingId() > 0) {
                    $this->lang['BuildingData'] = $data->getUnits()->getName($data->getPlanet()->getBBuildingId());
                } else {
                    $this->lang['BuildingData'] = 'free';
                }

                $this->lang['planet_image'] = 'skins/Maya/planeten/' . $data->getPlanet()->getImage() . '.png';


            } catch (Exception $e) {
                if (DEBUG) {
                    $debug->addLog(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                } else {
                    $debug->saveError(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                }
            }
        }

        /**
         * handles get-requests
         */
        function handleGET() : void {

            global $data;
            if (!empty($this->get['cp'])) {
                $data->getUser()->setCurrentPlanet(intval($this->get['cp']));
            }
        }

        /**
         * handles post-requests
         */
        function handlePOST() : void {

            if (!empty($this->post['abandon'])) {
                echo 'Destroy';
            } else {
                if (!empty($this->post['rename'])) {
                    if (!empty($this->post['newname'])) {
                        $this->post['newname'] = str_replace(' ', '-',
                            $this->post['newname']); // Replaces all spaces with hyphens.
                        $this->post['newname'] = preg_replace('/[^A-Za-z0-9\-]/', '',
                            $this->post['newname']); // Removes special chars.
                        echo $this->post['newname'];
                    } else {
                        echo 'empty name';
                    }
                }
            }
        }

        /**
         * display the page
         * @throws FileNotFoundException
         */
        function display() : void {

            global $config;

            $view = new V_Overview();

            $this->lang = array_merge($this->lang, M_Overview::loadLanguage());

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
