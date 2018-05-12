<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class C_Users implements I_Controller {

        private $get = null;

        private $post = null;

        private $skin = 'css/admin.css';

        private $lang = null;

        function __construct($get, $post) {

            $this->get = $get;
            $this->post = $post;

            if (!empty($get)) {
                self::handleGET();
            }

            if (!empty($post)) {
                self::handlePOST();
            }

            $users = M_Users::loadUsers();

            $this->lang['userlist'] = '';


            foreach ($users as $key => $value) {
                $this->lang['userlist'] .= '<tr><td>' . $value->user_userID . '</td><td>' . $value->user_username . '</td><td>' . $value->user_onlinetime . '</td><td>' . $value->user_currentplanet . '</td></tr>';
            }

        }

        function handleGET() {

        }

        function handlePOST() {

        }

        function display() {


            $view = new V_Users();

            $this->lang = array_merge($this->lang, M_Users::loadLanguage());

            $view->assign('lang', $this->lang);
            $view->assign('title', Config::$gameConfig['game_name']);
            $view->assign('skinpath', $this->skin);
            $view->assign('copyright', Config::$gameConfig['copyright']);
            $view->assign('language', Config::$pathConfig['language']);

            echo $view->loadTemplate();
        }
    }
