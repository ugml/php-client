<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    require $path['interfaces'] . 'controller.interface.php';

    class C_Register implements I_Controller {

        private $get = null;

        private $post = null;

        private $skin = 'css/register.css';

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

        function handleGET() : void {

        }

        function handlePOST() : void {

            if ($_POST) {

                $validPost = true;

                if (empty($_POST['username'])) {
                    echo 'please enter a username.';
                    $validPost = false;
                }

                if (empty($_POST['planetname'])) {
                    echo 'please enter a name for your planet. ';
                    $validPost = false;
                }

                if (empty($_POST['email'])) {
                    echo 'please enter a email-address. ';
                    $validPost = false;
                }

                if (empty($_POST['password'])) {
                    echo 'please enter a password. ';
                    $validPost = false;

                }

                if (empty($_POST['agb'])) {
                    echo 'you have to accept the T&C.';
                    $validPost = false;
                }

                if ($validPost) {
                    M_Register::createNewUser($_POST['username'], $_POST['planetname'], $_POST['email'],
                        $_POST['password']);
                }
            }
        }

        function display() : void {

            global $config;

            $view = new V_Register();

            $view->assign('lang', M_Register::loadLanguage());
            $view->assign('title', $config['game_name']);
            $view->assign('stylesheet', $this->skin);
            $view->assign('copyright', $config['copyright']);
            $view->assign('language', $config['language']);

            die($view->loadTemplate());
        }
    }
