<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class C_Register implements I_Controller {

        private $get = null;

        private $post = null;

        private $skin = 'css/register.css';

        private $view = null;

        private $model = null;

        /**
         * C_Register constructor.
         * @param $get
         * @param $post
         */
        function __construct($get, $post) {

            $this->get = $get;
            $this->post = $post;

            $this->view = new V_Register();
            $this->model = new M_Register();

            if (!empty($get)) {
                self::handleGET();
            }

            if (!empty($post)) {
                self::handlePOST();
            }

        }

        /**
         * handles get-requests
         */
        function handleGET() : void {

        }

        /**
         * handles post-requests
         */
        function handlePOST() : void {

            $validPost = true;

            $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);

            if (strlen($username) == 0) {
                echo 'please enter a username.';
                $validPost = false;
            }

            //                if (empty($_POST['planetname'])) {
            //                    echo 'please enter a name for your planet. ';
            //                    $validPost = false;
            //                }

            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                echo 'please enter a email-address. ';
                $validPost = false;
            }

            $email = $_POST['email'];
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

            if (strlen($password) == 0) {
                echo 'please enter a password. ';
                $validPost = false;

            }

            //                if (empty($_POST['agb'])) {
            //                    echo 'you have to accept the T&C.';
            //                    $validPost = false;
            //                }

            if ($validPost) {
                $return = $this->model->createNewUser($username, $_POST['planetname'], $email, $password);

                if ($return == 0) {
                    // TODO: display success-message
                    $this->view->assign('success', true);
                }
            }
        }

        /**
         * display the page
         */
        function display() : void {


            $this->view->assign('lang', $this->model->loadLanguage());
            $this->view->assign('title', Config::$gameConfig['game_name']);
            $this->view->assign('stylesheet', $this->skin);
            $this->view->assign('copyright', Config::$gameConfig['copyright']);
            $this->view->assign('language', Config::$pathConfig['language']);

            echo $this->view->loadTemplate();
        }
    }