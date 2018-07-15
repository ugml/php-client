<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class C_Building implements I_Controller {

        private $get = null;

        private $post = null;

        private $model = null;

        private $view = null;

        private $lang = null;

        function __destruct() {
            unset($this->get);
            unset($this->post);
            unset($this->model);
            unset($this->view);
            unset($this->lang);
        }

        /**
         * C_Building constructor.
         * @param $get
         * @param $post
         */
        function __construct($get, $post) {

            global $debug;

            try {

                $this->model = new M_Building();
                $this->view = new V_Building();

                $this->get = $get;
                $this->post = $post;

                if (!empty($this->get)) {
                    self::handleGET();
                }

                if (!empty($post)) {
                    self::handlePOST();
                }

                $this->lang['planet_dropdown'] = "";

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

            // change current planet
            if (!empty($this->get['cp'])) {
                Loader::getUser()->setCurrentPlanet(intval($this->get['cp']));
            }

            if (isset($this->get['build'])) {

                $id = intval(filter_input(INPUT_GET, 'build', FILTER_VALIDATE_INT));

                // if the passed value was of type integer, the $id should be set and not null
                if (isset($id) && $id != null) {
                    if ($id > 0) {
                        $this->build($id);
                    } else {
                        throw new InvalidArgumentException("buildID must not be zero or negative");
                    }
                } else {
                    throw new InvalidArgumentException("buildID must be set and of type integer");
                }
            }

            if (isset($this->get['cancel']) && Loader::getPlanet()->getBBuildingID() > 0) {

                $id = intval(filter_input(INPUT_GET, 'cancel', FILTER_VALIDATE_INT));

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

        /**
         * build the building with the given ID
         * @param $buildID the given building-id
         */
        function build($buildID) : void {

            global $debug;

            try {
                if ($buildID < 1 || $buildID > 99 || !array_key_exists($buildID, D_Units::getBuildings())) {
                    throw new InvalidArgumentException("ID out of range");
                }

                //build it only, if there is not already a building in the queue
                if (Loader::getPlanet()->getBBuildingId() == 0) {



                    $level = Loader::getBuildingData()->getBuildingByID(intval($buildID));

                    $metal = Loader::getBuildingList()[$buildID]->getCostMetal();
                    $crystal = Loader::getBuildingList()[$buildID]->getCostCrystal();
                    $deuterium = Loader::getBuildingList()[$buildID]->getCostDeuterium();


                    if (Loader::getPlanet()->getMetal() >= $metal &&
                        Loader::getPlanet()->getCrystal() >= $crystal &&
                        Loader::getPlanet()->getDeuterium() >= $deuterium) {

                        $n_metal = Loader::getPlanet()->getMetal() - $metal;
                        $n_crystal = Loader::getPlanet()->getCrystal() - $crystal;
                        $n_deuterium = Loader::getPlanet()->getDeuterium() - $deuterium;

                        $toLvl = $level + 1;

                        $this->model->build(Loader::getPlanet()->getPlanetId(), $buildID, $toLvl, $n_metal, $n_crystal,
                            $n_deuterium);
                        //header("Refresh:0");
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

        /**
         * cancels the current buildprogress
         * @param $buildID
         */
        function cancel($buildID) : void {

            if (Loader::getPlanet()->getBBuildingId() == $buildID && Loader::getPlanet()
                    ->getBBuildingEndtime() > time()) {

                $pricelist = D_Units::getPriceList($buildID);

                $level = Loader::getBuildingList()[$buildID]->getLevel();

                $metal = $pricelist['metal'];
                $crystal = $pricelist['crystal'];
                $deuterium = $pricelist['deuterium'];

                // calculate the total costs up to this level
                for ($i = 0; $i < $level; $i++) {
                    $metal *= $pricelist['factor'];
                    $crystal *= $pricelist['factor'];
                    $deuterium *= $pricelist['factor'];
                }

                $this->model->cancel(Loader::getPlanet()->getPlanetId(), $metal, $crystal, $deuterium);
            }

            //header("Refresh:0");

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

            $this->lang['building_list'] = $this->view->loadBuildingRows(Loader::getBuildingList(),
                D_Units::getBuildings(), Loader::getPlanet());

            if (is_array($this->lang) && is_array($v_lang)) {
                $this->lang = array_merge($this->lang, $v_lang);
            } else {
                if (!isset($this->lang) && empty($this->lang) && isset($v_lang) && !empty($v_lang)) {
                    $this->lang = $v_lang;
                }
            }


            $this->view->assign('lang', $this->lang);


            if (!empty($this->get['mode'])) {
                echo $this->view->loadTemplate($this->get['mode']);
            } else {
                echo $this->view->loadTemplate();
            }
        }
    }
