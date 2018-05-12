<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class C_Dashboard implements I_Controller {

        private $get = null;

        private $post = null;

        private $skin = 'css/admin.css';

        function __construct($get, $post) {

            $this->get = $get;
            $this->post = $post;

            if (!empty($get)) {
                self::handleGET();
            }

            if (!empty($post)) {
                self::handlePOST();
            }

        }

        function handleGET() {

        }

        function handlePOST() {

        }

        function display() {


            $view = new V_Dashboard();

            $view->assign('lang', M_Dashboard::loadLanguage());
            $view->assign('title', Config::$gameConfig['game_name']);
            $view->assign('skinpath', $this->skin);
            $view->assign('copyright', Config::$gameConfig['copyright']);
            $view->assign('language', Config::$pathConfig['language']);

            echo $view->loadTemplate();
        }
    }
