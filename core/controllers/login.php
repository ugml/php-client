<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class C_Login implements I_Controller {

        private $get = null;
        private $post = null;

        private $view = null;
        private $model = null;

        private $skin = 'css/login.css';

        function __construct($get, $post) {

            $this->get = $get;
            $this->post = $post;

            $this->view = new V_Login();
            $this->model = new M_Login();

            if (!empty($get)) {
                self::handleGET();
            }

            if (!empty($post)) {
                self::handlePOST();
            }

        }

        function handleGET() : void {

        }

        function handlePOST() : void {

            if ($_POST) {
                $user = $this->model->getUserInfo($_POST['username']);
                if ($user) {
                    if (password_verify($_POST['password'], $user->password)) {
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



            $this->view->assign('lang', $this->model->loadLanguage());
            $this->view->assign('title', Config::$gameConfig['game_name']);
            $this->view->assign('skinpath', $this->skin);
            $this->view->assign('copyright', Config::$gameConfig['copyright']);
            $this->view->assign('language', Config::$pathConfig['language']);

            echo $this->view->loadTemplate();
        }
    }
