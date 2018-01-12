<?php

    declare(strict_types=1);

    defined('INSIDE') OR exit('No direct script access allowed');

    require $path['interfaces'].'controller.interface.php';

    class C_Login implements I_Controller {

        private $get = null;
        private $post = null;
        private $skin = 'css/login.css';


        function __construct($get, $post) {
            $this->get = $get;
            $this->post = $post;

            if(!empty($get)){
                self::handleGET();
            }

            if(!empty($post)){
                self::handlePOST();
            }

        }

        function handleGET() : void {

        }

        function handlePOST() : void {

            if($_POST) {
                $user = M_Login::getUserInfo($_POST['username']);
                if($user) {
                    if(password_verify($_POST['password'], $user->password)) {
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        $_SESSION['userID'] = $user->userID;

                        header('Location: game.php');
                    } else {
                        echo 'wrong password';
                    }
                } else {
                    echo 'user not found';
                }
            }
        }

        function display() : void {
            global $config;

            $view = new V_Login();

            $view->assign('lang', M_Login::loadLanguage());
            $view->assign('title',$config['game_name']);
            $view->assign('skinpath',$this->skin);
            $view->assign('copyright',$config['copyright']);
            $view->assign('language',$config['language']);

            die($view->loadTemplate());
        }
    }
