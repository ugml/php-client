<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class C_Register implements I_Controller {

        private $get = null;

        private $post = null;

        private $skin = 'css/register.css';

        private $view = null;

        /**
         * C_Register constructor.
         * @param $get
         * @param $post
         */
        function __construct($get, $post) {

            $this->get = $get;
            $this->post = $post;

            $this->view = new V_Register();

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

            if ($_POST) {

                $validPost = true;

                if (empty($_POST['username'])) {
                    echo 'please enter a username.';
                    $validPost = false;
                }

//                if (empty($_POST['planetname'])) {
//                    echo 'please enter a name for your planet. ';
//                    $validPost = false;
//                }

                if (empty($_POST['email'])) {
                    echo 'please enter a email-address. ';
                    $validPost = false;
                }

                if (empty($_POST['password'])) {
                    echo 'please enter a password. ';
                    $validPost = false;

                }

//                if (empty($_POST['agb'])) {
//                    echo 'you have to accept the T&C.';
//                    $validPost = false;
//                }

                if ($validPost) {
                    $return = M_Register::createNewUser($_POST['username'], $_POST['planetname'], $_POST['email'],
                        $_POST['password']);

                    if($return == 0) {
                        // TODO: display success-message
                        $this->view->assign('success', true);
                    }
                }
            }
        }

        /**
         * display the page
         */
        function display() : void {

            global $config;



            $this->view->assign('lang', M_Register::loadLanguage());
            $this->view->assign('title', $config['game_name']);
            $this->view->assign('stylesheet', $this->skin);
            $this->view->assign('copyright', $config['copyright']);
            $this->view->assign('language', $config['language']);

            echo $this->view->loadTemplate();
        }
    }
