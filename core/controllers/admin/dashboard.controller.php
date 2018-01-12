<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    require $path['interfaces'] . 'controller.interface.php';

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

            global $config;

            $view = new V_Dashboard();

            $view->assign('lang', M_Dashboard::loadLanguage());
            $view->assign('title', $config['game_name']);
            $view->assign('skinpath', $this->skin);
            $view->assign('copyright', $config['copyright']);
            $view->assign('language', $config['language']);

            die($view->loadTemplate());
        }
    }
