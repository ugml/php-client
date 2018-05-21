<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class C_Fleet implements I_Controller {

        private $get = null;

        private $post = null;

        private $lang = null;

        private $model = null;

        private $view = null;

        function __construct($get, $post) {

            global $debug;

            try {

                $this->model = new M_Fleet();
                $this->view = new V_Fleet();

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

            if (!empty($this->get['cp'])) {
                Loader::getUser()->setCurrentPlanet(intval($this->get['cp']));
            }


        }

        function handlePOST() : void {
        }

        function display() : void {

            $v_lang = $this->model->loadLanguage();

            if (is_array($this->lang) && is_array($v_lang)) {
                $this->lang = array_merge($this->lang, $v_lang);
            } else {
                if (!isset($this->lang) && empty($this->lang) && isset($v_lang) && !empty($v_lang)) {
                    $this->lang = $v_lang;
                }
            }


            $this->view->assign('lang', $this->lang);
            $this->view->assign('title', Config::$gameConfig['game_name']);
            $this->view->assign('skinpath', Config::$gameConfig['skinpath']);
            $this->view->assign('copyright', Config::$gameConfig['copyright']);
            $this->view->assign('language', Config::$pathConfig['language']);

            if (!empty($this->get['mode'])) {
                echo $this->view->loadTemplate($this->get['mode']);
            } else {
                echo $this->view->loadTemplate();
            }
        }
    }
