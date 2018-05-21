<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class C_Shipyard implements I_Controller {

        private $get = null;

        private $post = null;

        private $lang = null;

        private $model = null;

        private $view = null;

        function __construct($get, $post) {
            global $debug;

            try {

                $this->model = new M_Shipyard();
                $this->view = new V_Shipyard();

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

        function handleGET() : void {

            if (!empty($this->get['cp'])) {
                Loader::getUser()->setCurrentPlanet(intval($this->get['cp']));
            }

            if (isset($this->get['cancel'])) {

                $id = filter_input(INPUT_GET, 'cancel', FILTER_VALIDATE_INT);

                // if the passed value was of type integer, the $id should be set and not null
                if (isset($id) && $id != null) {
                    if ($id > 0) {
                        if (Loader::getPlanet()->getBBuildingID() == $id) {
                            $this->cancel($id);
                        } else {
                            throw new InvalidArgumentException("cancelID does not match currently building id");
                        }
                    } else {
                        throw new InvalidArgumentException("cancelID must not be zero or negative");
                    }
                } else {
                    throw new InvalidArgumentException("cancelID must be set and of type integer");
                }

            }
        }

        function handlePOST() : void {

            if (isset($this->post) && sizeof($this->post) > 0) {
                $buildQueue = [];
                foreach ($this->post as $k => $v) {
                    if ($v != null && intval($v) > 0) {
                        array_push($buildQueue, array($k => $v));
                    }
                }

                if (sizeof($buildQueue) > 0) {
                    $this->build($buildQueue);
                }

            }
        }

        function build(array $buildQueue) : void {

            if (Loader::getPlanet()->getBHangarPlus() > 0) {
                throw new InvalidArgumentException("cant build while shipyard is upgrading");
            }

            $totalMetal = 0;
            $totalCrystal = 0;
            $totalDeuterium = 0;

            $buildList = [];

            $done = false;

            foreach ($buildQueue as $k => $v) {
                if (!$done) {
                    $shipID = key($v);
                    $shipCnt = $v[$shipID];

                    $pricelist = D_Units::getPriceList($shipID);

                    //                    echo $shipID;
                    //                    echo "<br />";
                    //                    print_r($pricelist);

                    $maxBuildable = 0;

                    $currentMetal = Loader::getPlanet()->getMetal() - $totalMetal;
                    $currentCrystal = Loader::getPlanet()->getCrystal() - $totalCrystal;
                    $currentDeuterium = Loader::getPlanet()->getDeuterium() - $totalDeuterium;

                    // not enough ressources for all ships
                    if ($currentMetal < ($pricelist['metal'] * $shipCnt) ||
                        $currentCrystal < ($pricelist['crystal'] * $shipCnt) ||
                        $currentDeuterium < ($pricelist['deuterium'] * $shipCnt)) {

                        $minMet = $shipCnt;
                        $minCry = $shipCnt;
                        $minDeut = $shipCnt;

                        // prevent division by zero
                        if ($pricelist['metal'] > 0) {
                            $minMet = $currentMetal / $pricelist['metal'];
                        }

                        // prevent division by zero
                        if ($pricelist['crystal'] > 0) {
                            $minCry = $currentCrystal / $pricelist['crystal'];
                        }

                        // prevent division by zero
                        if ($pricelist['deuterium'] > 0) {
                            $minDeut = $currentDeuterium / $pricelist['deuterium'];
                        }

                        $maxBuildable = floor(min($minMet, $minCry, $minDeut));

                    } else {
                        // player can afford all ships
                        $maxBuildable = $shipCnt;
                    }

                    if ($maxBuildable > 0) {
                        // calculate the total costs
                        $totalMetal += $pricelist['metal'] * $maxBuildable;
                        $totalCrystal += $pricelist['crystal'] * $maxBuildable;
                        $totalDeuterium += $pricelist['deuterium'] * $maxBuildable;

                        array_push($buildList, array($shipID => $maxBuildable));

                    }

                    if ($maxBuildable < $shipCnt) {
                        // could not afford all ships -> quit the rest
                        $done = true;
                    }
                }

            }

            $this->model->build(intval(Loader::getPlanet()->getPlanetId()), $buildList, intval($totalMetal),
                intval($totalMetal), intval($totalDeuterium));

        }

        function display() : void {

            $v_lang = $this->model->loadLanguage();

            // load the individual rows for each building
            $this->lang['shipyard_list'] = $this->view->loadShipyardRows();

            if (is_array($this->lang) && is_array($v_lang)) {
                $this->lang = array_merge($this->lang, $v_lang);
            } else {
                if (!isset($this->lang) && empty($this->lang) && isset($v_lang) && !empty($v_lang)) {
                    $this->lang = $v_lang;
                }
            }


            $this->view->assign('lang', $this->lang);
            $this->view->assign('title', Config::$gameConfig['game_name']);
            $this->view->assign('skinpath', Config::$gameConfig['skinpath']);
            $this->view->assign('copyright', Config::$gameConfig['copyright']);
            $this->view->assign('language', Config::$gameConfig['language']);

            if (!empty($this->get['mode'])) {
                echo $this->view->loadTemplate($this->get['mode']);
            } else {
                echo $this->view->loadTemplate();
            }
        }
    }
