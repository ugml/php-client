<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class C_Changelog implements I_Controller {

        private $get = null;

        private $post = null;

        private $lang = null;

        /**
         * C_Changelog constructor.
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

        }

        /**
         * display the page
         * @throws FileNotFoundException
         */
        function display() : void {

            global $config;

            // load view
            $view = new V_Changelog();

            $this->lang = M_Changelog::loadLanguage();

            $this->lang['changelog_list'] = $view->loadChangelogRows();


            $view->assign('lang', $this->lang);
            $view->assign('title', $config['game_name']);
            $view->assign('skinpath', $config['skinpath']);
            $view->assign('copyright', $config['copyright']);
            $view->assign('language', Config::$pathConfig['language']);

            if (!empty($this->get['mode'])) {
                echo $view->loadTemplate($this->get['mode']);
            } else {
                echo $view->loadTemplate();
            }
        }
    }
