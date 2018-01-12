<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    require $path['interfaces'].'controller.interface.php';

    class C_Users implements I_Controller {

        private $get = null;
        private $post = null;
        private $skin = 'css/admin.css';
        private $lang = null;


        function __construct($get, $post){
            $this->get = $get;
            $this->post = $post;

            if(!empty($get)){
                self::handleGET();
            }

            if(!empty($post)){
                self::handlePOST();
            }

            $users = M_Users::loadUsers();

            $this->lang['userlist'] = '';



            foreach($users as $k => $v) {
                $this->lang['userlist'] .= '<tr><td>'.$v->user_userID.'</td><td>'.$v->user_username.'</td><td>'.$v->user_onlinetime.'</td><td>'.$v->user_currentplanet.'</td></tr>';
            }

        }

        function handleGET() {

        }

        function handlePOST() {

        }

        function display() {
            global $config;

            $view = new V_Users();

            $this->lang = array_merge($this->lang, M_Users::loadLanguage());

            $view->assign('lang', $this->lang);
            $view->assign('title',$config['game_name']);
            $view->assign('skinpath',$this->skin);
            $view->assign('copyright',$config['copyright']);
            $view->assign('language',$config['language']);

            die($view->loadTemplate());
        }
    }
