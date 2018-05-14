<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class C_Overview implements I_Controller {

        private $get = null;

        private $post = null;

        private $lang = null;

        private $model = null;

        /**
         * C_Overview constructor.
         * @param $get
         * @param $post
         */
        function __construct($get, $post) {

            global $debug;

            $this->model = new M_Overview();

            try {
                $this->get = $get;
                $this->post = $post;

                if (!empty($this->get)) {
                    self::handleGET();
                }

                if (!empty($post)) {
                    self::handlePOST();
                }

                require_once(Config::$pathConfig['classes'] . "topbar.php");


                if (!empty($this->get['mode'])) {
                    switch ($this->get['mode']) {
                        case 'renameplanet':
                            $this->lang['planet_id'] = Loader::getUser()->getCurrentPlanet();
                            break;
                    }
                } else {
                    //                    $this->lang['galaxy_metal'] = number_format(Loader::getGalaxy()->getDebrisMetal(), 0);
                    //                    $this->lang['galaxy_crystal'] = number_format(Loader::getGalaxy()->getDebrisCrystal(), 0);
                    $this->lang['time'] = time();
                }

                // currently building?
                if (Loader::getPlanet()->getBBuildingId() > 0) {
                    $this->lang['building'] = D_Units::getName(Loader::getPlanet()
                            ->getBBuildingId()) . " ({level} " . (Loader::getBuildingList()[Loader::getPlanet()
                                ->getBBuildingId()]->getLevel() + 1) . ")<br />" .
                        "<span class='timer'></span><script>timer(\"overview\", " . (Loader::getPlanet()
                                ->getBBuildingEndtime() - time()) . ", 'timer', " . Loader::getPlanet()
                            ->getBBuildingId() . ", '');</script><br />" .
                        "<a href='?page=building&cancel=" . Loader::getPlanet()->getBBuildingId() . "'>{cancel}</a>";
                } else {
                    $this->lang['building'] = 'free';
                }

                $this->lang['user_points'] = number_format(Loader::getUser()->getPoints(), 0);
                $this->lang['user_rank'] = number_format(Loader::getUser()->getCurrentRank(), 0);
                $this->lang['num_users'] = number_format($this->model->getNumUsers(), 0);


                // TODO: if planet has moon -> show moon
                $this->lang['moon_image'] = '<img src="' . Config::$gameConfig['skinpath'] . '/planeten/small/s_mond.png" />';


                $this->lang['planet_image'] = Config::$gameConfig['skinpath'] . 'planeten/' . Loader::getPlanet()
                        ->getImage() . '.png';


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

            if (!empty($this->get['cp'])) {
                Loader::getUser()->setCurrentPlanet(intval($this->get['cp']));
            }
        }

        /**
         * handles post-requests
         */
        function handlePOST() : void {

            if (!empty($this->post['abandon'])) {
                echo 'Destroy';
            } else {
                if (!empty($this->post['rename'])) {
                    if (!empty($this->post['newname'])) {
                        $this->post['newname'] = str_replace(' ', '-',
                            $this->post['newname']); // Replaces all spaces with hyphens.
                        $this->post['newname'] = preg_replace('/[^A-Za-z0-9\-]/', '',
                            $this->post['newname']); // Removes special chars.
                        echo $this->post['newname'];
                    } else {
                        echo 'empty name';
                    }
                }
            }
        }

        /**
         * display the page
         * @throws FileNotFoundException
         */
        function display() : void {

            $view = new V_Overview();

            $this->lang = array_merge($this->lang, $this->model->loadLanguage());

            $view->assign('lang', $this->lang);
            $view->assign('title', Config::$gameConfig['game_name']);
            $view->assign('skinpath', Config::$gameConfig['skinpath']);

            $view->assign('copyright', Config::$gameConfig['copyright']);
            $view->assign('language', Config::$pathConfig['language']);

            if (!empty($this->get['mode'])) {
                echo $view->loadTemplate($this->get['mode']);
            } else {
                echo $view->loadTemplate();
            }
        }
    }
