<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class C_Resources implements I_Controller {

        private $get = null;

        private $post = null;

        private $lang = null;

        private $view = null;

        private $model = null;

        private $planetID = null;

        /**
         * C_Resources constructor.
         * @param $get
         * @param $post
         */
        function __construct($get, $post) {

            global $debug;

            try {
                $this->planetID = Loader::getUser()->getCurrentPlanet();
                $this->get = $get;
                $this->post = $post;

                if (!empty($this->get)) {
                    self::handleGET();
                }

                if (!empty($post)) {
                    self::handlePOST();
                }

                require_once(Config::$pathConfig['classes'] . "topbar.php");


                // base income
                $this->lang['config_base_income_metal'] = number_format(Config::$gameConfig['base_income_metal'], 0);
                $this->lang['config_base_income_crystal'] = number_format(Config::$gameConfig['base_income_crystal'], 0);
                $this->lang['config_base_income_deuterium'] = number_format(Config::$gameConfig['base_income_deuterium'], 0);
                $this->lang['config_base_income_energy'] = number_format(Config::$gameConfig['base_income_energy'], 0);


                $this->model = new M_Resources();


                // planet storage
                $this->lang['planet_storage_metal'] = number_format(D_Units::getStorageCapacity(Loader::getBuildingList()[D_Units::getUnitID('metal_storage')]->getLevel()),
                    0);
                $this->lang['planet_storage_crystal'] = number_format(D_Units::getStorageCapacity(Loader::getBuildingList()[D_Units::getUnitID('crystal_storage')]->getLevel()),
                    0);
                $this->lang['planet_storage_deuterium'] = number_format(D_Units::getStorageCapacity(Loader::getBuildingList()[D_Units::getUnitID('deuterium_storage')]->getLevel()),
                    0);

                // load view
                $this->view = new V_Resources();

                $this->lang['resource_row'] = '';

                // production
                $prod_metal = D_Units::getMetalProductionPerHour(Loader::getBuildingList()[D_Units::getUnitID('metal_mine')]->getLevel());
                $prod_crystal = D_Units::getCrystalProductionPerHour(Loader::getBuildingList()[D_Units::getUnitID('crystal_mine')]->getLevel());
                $prod_deuterium = D_Units::getDeuteriumProductionPerHour(Loader::getBuildingList()[D_Units::getUnitID('deuterium_synthesizer')]->getLevel());

                $prod_energy_array = D_Units::getEnergyProduction(
                    Loader::getBuildingList()[D_Units::getUnitID('solar_plant')]->getLevel(),
                    Loader::getBuildingList()[D_Units::getUnitID('fusion_reactor')]->getLevel(),
                    Loader::getTechList()[D_Units::getUnitID('energy_tech')]->getLevel(),
                    Loader::getFleetList()[D_Units::getUnitID('solar_satellite')]->getAmount(),
                    Loader::getPlanet()->getTempMax()
                );

                $prod_energy_total = 0;

                if (Loader::getBuildingList()['metal_mine'] > 0) {
                    $energy = -D_Units::getEnergyConsumption(Loader::getBuildingList()['metal_mine']);
                    $prod_energy_total += $energy;

                    $lang_row['building_id'] = D_Units::getUnit(1);
                    $lang_row['building_name'] = D_Units::getName(1);
                    $lang_row['building_production_metal'] = number_format($prod_metal, 0);
                    $lang_row['building_production_crystal'] = 0;
                    $lang_row['building_production_deuterium'] = 0;
                    $lang_row['building_production_energy'] = number_format($energy, 0);
                    $lang_row['building_level'] = Loader::getBuildingList()->getMetalMine();

                    $lang_row['production_options'] = $this->generateProductionOptions(D_Units::getUnit(1),
                        Loader::getPlanet()->getMetalMinePercent());
                    $this->view->assign('lang', $lang_row);

                    $this->lang['resource_row'] .= $this->view->loadResourceRow();
                }

                if (Loader::getBuildingList()['crystal_mine'] > 0) {
                    $energy = -D_Units::getEnergyConsumption(Loader::getBuildingList()->getCrystalMine());
                    $prod_energy_total += $energy;

                    $lang_row['building_id'] = D_Units::getUnit(2);
                    $lang_row['building_name'] = D_Units::getName(2);
                    $lang_row['building_production_metal'] = 0;
                    $lang_row['building_production_crystal'] = number_format($prod_crystal, 0);
                    $lang_row['building_production_deuterium'] = 0;
                    $lang_row['building_production_energy'] = number_format($energy, 0);
                    $lang_row['building_level'] = Loader::getBuildingList()->getCrystalMine();

                    $lang_row['production_options'] = $this->generateProductionOptions(D_Units::getUnit(2),
                        Loader::getPlanet()->getCrystalMinePercent());

                    $this->view->assign('lang', $lang_row);

                    $this->lang['resource_row'] .= $this->view->loadResourceRow();
                }

                if (Loader::getBuildingList()['deuterium_synthesizer'] > 0) {
                    $energy = -D_Units::getEnergyConsumption(Loader::getBuildingList()->getDeuteriumSynthesizer());
                    $prod_energy_total += $energy;

                    $lang_row['building_id'] = D_Units::getUnit(3);
                    $lang_row['building_name'] = D_Units::getName(3);
                    $lang_row['building_production_metal'] = 0;
                    $lang_row['building_production_crystal'] = 0;
                    $lang_row['building_production_deuterium'] = number_format($prod_deuterium, 0);
                    $lang_row['building_production_energy'] = number_format($energy, 0);

                    $lang_row['building_level'] = Loader::getBuildingList()->getDeuteriumSynthesizer();

                    $lang_row['production_options'] = $this->generateProductionOptions(D_Units::getUnit(3),
                        Loader::getPlanet()->getDeuteriumSynthesizerPercent());

                    $this->view->assign('lang', $lang_row);

                    $this->lang['resource_row'] .= $this->view->loadResourceRow();
                }

                if (Loader::getBuildingList()['solar_plant'] > 0) {
                    $energy = $prod_energy_array['solar_plant'];
                    $prod_energy_total += $energy;

                    $lang_row['building_id'] = 'solar_plant';
                    $lang_row['building_name'] = D_Units::getName(D_Units::getUnitID('solar_plant'));
                    $lang_row['building_production_metal'] = 0;
                    $lang_row['building_production_crystal'] = 0;
                    $lang_row['building_production_deuterium'] = 0;
                    $lang_row['building_production_energy'] = number_format($energy, 0);
                    $lang_row['building_level'] = Loader::getBuildingList()['solar_plant'];

                    $lang_row['production_options'] = $this->generateProductionOptions(D_Units::getUnit(4),
                        Loader::getPlanet()->getSolarPlantPercent());

                    $this->view->assign('lang', $lang_row);

                    $this->lang['resource_row'] .= $this->view->loadResourceRow();
                }

                if (Loader::getBuildingList()['fusion_reactor'] > 0) {
                    $energy = $prod_energy_array[D_Units::getUnit(5)];
                    $prod_energy_total += $energy;

                    $lang_row['building_id'] = D_Units::getUnit(5);
                    $lang_row['building_name'] = D_Units::getName(5);
                    $lang_row['building_production_metal'] = 0;
                    $lang_row['building_production_crystal'] = 0;
                    $lang_row['building_production_deuterium'] = -10 * (Loader::getPlanet()
                                ->getFusionReactorPercent() / 100) * pow(1.1,
                            (Loader::getPlanet()->getFusionReactorPercent() / 100));
                    $lang_row['building_production_energy'] = number_format($energy, 0);

                    $lang_row['production_options'] = $this->generateProductionOptions(D_Units::getUnit(5),
                        Loader::getPlanet()->getFusionReactorPercent());

                    $lang_row['building_level'] = Loader::getBuildingList()->getSolarPlant();

                    $this->view->assign('lang', $lang_row);

                    $this->lang['resource_row'] .= $this->view->loadResourceRow();
                }

                if (Loader::getFleetList()['solar_satellite'] > 0) {
                    $energy = $prod_energy_array[D_Units::getUnit(211)];
                    $prod_energy_total += $energy;

                    $lang_row['building_name'] = D_Units::getName(211);
                    $lang_row['building_production_metal'] = 0;
                    $lang_row['building_production_crystal'] = 0;
                    $lang_row['building_production_deuterium'] = 0;
                    $lang_row['building_production_energy'] = number_format($energy, 0);
                    $lang_row['building_level'] = Loader::getFleetList()->getSolarSatellite();

                    $lang_row['production_options'] = $this->generateProductionOptions(D_Units::getUnit(211),
                        Loader::getPlanet()->getSolarSatellitePercent());

                    $this->view->assign('lang', $lang_row);

                    $this->lang['resource_row'] .= $this->view->loadResourceRow();
                }

                $this->lang['total_metal'] = number_format($base_income['metal'] + $prod_metal, 0);
                $this->lang['total_crystal'] = number_format($base_income['crystal'] + $prod_crystal, 0);
                $this->lang['total_deuterium'] = number_format($base_income['deuterium'] + $prod_deuterium, 0);
                $this->lang['total_energy'] = number_format($base_income['energy'] + $prod_energy_total, 0);

                // daily production
                $this->lang['production_daily_metal'] = number_format($prod_metal, 0);
                $this->lang['production_daily_crystal'] = number_format($prod_crystal, 0);
                $this->lang['production_daily_deuterium'] = number_format($prod_deuterium, 0);

                //weekly production
                $this->lang['production_weekly_metal'] = number_format($prod_metal * 7, 0);
                $this->lang['production_weekly_crystal'] = number_format($prod_crystal * 7, 0);
                $this->lang['production_weekly_deuterium'] = number_format($prod_deuterium * 7, 0);

                //monthly production
                $this->lang['production_monthly_metal'] = number_format($prod_metal * 7 * 30, 0);
                $this->lang['production_monthly_crystal'] = number_format($prod_crystal * 7 * 30, 0);
                $this->lang['production_monthly_deuterium'] = number_format($prod_deuterium * 7 * 30, 0);

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
        }

        function handlePOST() : void {

            global $debug;

            try {
                M_Resources::updateProductionLevels($this->planetID, $this->post);
            } catch (Exception $e) {
                if (DEBUG) {
                    $debug->addLog(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                } else {
                    $debug->saveError(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                }
            }
        }

        function generateProductionOptions($buildingID, $level) : string {

            $row = '<select name="' . $buildingID . '" size="1">';

            for ($i = 10; $i >= 0; $i--) {
                $selected = '';
                if ($i * 10 == $level) {
                    $selected = 'selected';
                }
                $row .= '<option value=\'' . $i * 10 . '\' ' . $selected . '>' . $i * 10 . '%</option>';
            }

            $row .= '</select>';

            return $row;
        }

        function display() : void {

            global $debug;

            try {
                $this->lang = array_merge($this->lang, $this->model->loadLanguage());

                $this->view->assign('lang', $this->lang);
                $this->view->assign('title', Config::$gameConfig['game_name']);
                $this->view->assign('skinpath', Config::$gameConfig['skinpath']);
                $this->view->assign('copyright', Config::$gameConfig['copyright']);
                $this->view->assign('language', Config::$pathConfig['language']);

                echo $this->view->loadTemplate();

            } catch (Exception $e) {
                if (DEBUG) {
                    $debug->addLog(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                } else {
                    $debug->saveError(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                }
            }
        }
    }
