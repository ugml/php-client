<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    require $path['interfaces'] . 'controller.php';

    class C_Research implements I_Controller {

        private $get = null;

        private $post = null;

        private $lang = null;

        function __construct($get, $post) {

            global $data, $debug, $path;

            try {
                $this->get = $get;
                $this->post = $post;

                if (!empty($this->get)) {
                    self::handleGET();
                }

                if (!empty($post)) {
                    self::handlePOST();
                }

                require_once($path['classes'] . "topbar.php");


            } catch (Exception $e) {
                if (DEBUG) {
                    $debug->addLog(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                } else {
                    $debug->saveError(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                }
            }
        }

        function handleGET() : void {

            global $data;
            if (!empty($this->get['cp'])) {
                $data->getUser()->setCurrentPlanet(intval($this->get['cp']));
            }

            if (isset($this->get['build'])) {

                $id = filter_input(INPUT_GET, 'build', FILTER_VALIDATE_INT);

                // if the passed value was of type integer, the $id should be set and not null
                if (isset($id) && $id != null) {
                    if ($id > 0) {
                        $this->build($id);
                    } else {
                        throw new InvalidArgumentException("researchID must not be zero or negative");
                    }
                } else {
                    throw new InvalidArgumentException("researchID must be set and of type integer");
                }
            }

            if (isset($this->get['cancel']) && $data->getPlanet()->getBTechId() > 0) {

                $id = intval(filter_input(INPUT_GET, 'cancel', FILTER_VALIDATE_INT));

                // if the passed value was of type integer, the $id should be set and not null
                if (isset($id) && $id != null) {
                    if ($id > 0) {

                        if ($data->getPlanet()->getBTechId() == $id) {
                            $this->cancel($id);
                        } else {
                            throw new InvalidArgumentException("cancelID does not match currently research id");
                        }
                    } else {
                        throw new InvalidArgumentException("cancelID must not be zero or negative");
                    }
                } else {
                    throw new InvalidArgumentException("cancelID must be set and of type integer");
                }

            }
        }

        function build($buildID) : void {

            global $data, $debug;

            try {
                if ($buildID < 100 || $buildID > 199 || !array_key_exists($buildID,
                        $data->getUnits()->getTechnologies())) {
                    throw new InvalidArgumentException("ID out of range");
                }

                //build it only, if there is not already a building in the queue
                if ($data->getPlanet()->getBTechId() == 0) {

                    $pricelist = $data->getUnits()->getPriceList($buildID);

                    $methodArr = explode('_', $data->getUnits()->getUnit($buildID));

                    $method = 'get';

                    foreach ($methodArr as $a => $b) {
                        $method .= ucfirst($b);
                    }
                    $level = call_user_func_array(array($data->getTech(), $method), array());

                    $metal = $pricelist['metal'];
                    $crystal = $pricelist['crystal'];
                    $deuterium = $pricelist['deuterium'];

                    // calculate the total costs up to this level
                    for ($i = 0; $i < $level; $i++) {
                        $metal *= $pricelist['factor'];
                        $crystal *= $pricelist['factor'];
                        $deuterium *= $pricelist['factor'];
                    }


                    if ($data->getPlanet()->getMetal() >= $metal &&
                        $data->getPlanet()->getCrystal() >= $crystal &&
                        $data->getPlanet()->getDeuterium() >= $deuterium) {

                        $n_metal = $data->getPlanet()->getMetal() - $metal;
                        $n_crystal = $data->getPlanet()->getCrystal() - $crystal;
                        $n_deuterium = $data->getPlanet()->getDeuterium() - $deuterium;

                        $toLvl = $level + 1;

                        M_Research::build($data->getPlanet()->getPlanetId(), $buildID, $toLvl, $n_metal, $n_crystal,
                            $n_deuterium);
                        header("Refresh:0");

                    }
                }

            } catch (Exception $e) {
                if (DEBUG) {
                    $debug->addLog(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                } else {
                    $debug->saveError(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                }
            }

        }

        function cancel($buildID) : void {

            global $data;

            if ($data->getPlanet()->getBTechId() == $buildID && $data->getPlanet()->getBTechEndtime() > time()) {

                $pricelist = $data->getUnits()->getPriceList($buildID);

                $methodArr = explode('_', $data->getUnits()->getUnit($buildID));

                $method = 'get';

                foreach ($methodArr as $a => $b) {
                    $method .= ucfirst($b);
                }
                $level = call_user_func_array(array($data->getTech(), $method), array());

                $metal = $pricelist['metal'];
                $crystal = $pricelist['crystal'];
                $deuterium = $pricelist['deuterium'];

                // calculate the total costs up to this level
                for ($i = 0; $i < $level; $i++) {
                    $metal *= $pricelist['factor'];
                    $crystal *= $pricelist['factor'];
                    $deuterium *= $pricelist['factor'];
                }

                M_Research::cancel($data->getPlanet()->getPlanetId(), $metal, $crystal, $deuterium);
            }

            header("Refresh:0");

        }

        function handlePOST() : void {

        }

        function display() : void {

            global $config, $data;

            // load view
            $view = new V_Research();

            $v_lang = M_Research::loadLanguage();

            // load the individual rows for each building
            $this->lang['research_list'] = $view->loadResearchRows($data->getTech(),
                $data->getUnits()->getTechnologies(), $data->getPlanet());

            if (is_array($this->lang) && is_array($v_lang)) {
                $this->lang = array_merge($this->lang, $v_lang);
            } else {
                if (!isset($this->lang) && empty($this->lang) && isset($v_lang) && !empty($v_lang)) {
                    $this->lang = $v_lang;
                }
            }


            $view->assign('lang', $this->lang);
            $view->assign('title', $config['game_name']);
            $view->assign('skinpath', $config['skinpath']);
            $view->assign('copyright', $config['copyright']);
            $view->assign('language', $config['language']);

            if (!empty($this->get['mode'])) {
                die($view->loadTemplate($this->get['mode']));
            } else {
                die($view->loadTemplate());
            }
        }
    }
