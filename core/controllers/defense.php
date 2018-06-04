<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class C_Defense implements I_Controller {

        private $get = null;

        private $post = null;

        private $model = null;

        private $view = null;

        private $lang = null;

        /**
         * C_Building constructor.
         * @param $get
         * @param $post
         */
        function __construct($get, $post) {

            global $debug;

            try {

                $this->model = new M_Defense();
                $this->view = new V_Defense();

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

        /**
         * handles get-requests
         */
        function handleGET() : void {

        }

        /**
         * handles post-requests
         */
        function handlePOST() : void {

        }

        /**
         * display the page
         * @throws FileNotFoundException
         */
        function display() : void {

            $v_lang = $this->model->loadLanguage();

            // load the individual rows for each building

            $this->lang['building_list'] = $this->view->loadBuildingRows(Loader::getDefenseList(),
                D_Units::getDefense(), Loader::getPlanet());

            if (is_array($this->lang) && is_array($v_lang)) {
                $this->lang = array_merge($this->lang, $v_lang);
            } else {
                if (!isset($this->lang) && empty($this->lang) && isset($v_lang) && !empty($v_lang)) {
                    $this->lang = $v_lang;
                }
            }


            $this->view->assign('lang', $this->lang);


            echo $this->view->loadTemplate();

        }
    }
