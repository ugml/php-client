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

            global $data, $debug, $base_income, $units;

            try {
                $this->planetID = $data->getUser()->getCurrentPlanet();
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
                $this->lang['config_base_income_metal'] = number_format($base_income['metal'], 0);
                $this->lang['config_base_income_crystal'] = number_format($base_income['crystal'], 0);
                $this->lang['config_base_income_deuterium'] = number_format($base_income['deuterium'], 0);
                $this->lang['config_base_income_energy'] = number_format($base_income['energy'], 0);


                $this->model = new M_Resources();




                // planet storage
                $this->lang['planet_storage_metal'] = number_format($units->getStorageCapacity($data->getBuildingList()[$units->getUnitID('metal_storage')]->getLevel()),
                    0);
                $this->lang['planet_storage_crystal'] = number_format($units->getStorageCapacity($data->getBuildingList()[$units->getUnitID('crystal_storage')]->getLevel()),
                    0);
                $this->lang['planet_storage_deuterium'] = number_format($units->getStorageCapacity($data->getBuildingList()[$units->getUnitID('deuterium_storage')]->getLevel()),
                    0);

                // load view
                $this->view = new V_Resources();

                $this->lang['resource_row'] = '';

                // production
                $prod_metal = $units->getMetalProductionPerHour($data->getBuildingList()[$units->getUnitID('metal_mine')]->getLevel());
                $prod_crystal = $units->getCrystalProductionPerHour($data->getBuildingList()[$units->getUnitID('crystal_mine')]->getLevel());
                $prod_deuterium = $units->getDeuteriumProductionPerHour($data->getBuildingList()[$units->getUnitID('deuterium_synthesizer')]->getLevel());

                $prod_energy_array = $units->getEnergyProduction(
                    $data->getBuildingList()[$units->getUnitID('solar_plant')]->getLevel(),
                    $data->getBuildingList()[$units->getUnitID('fusion_reactor')]->getLevel(),
                    $data->getTechList()[$units->getUnitID('energy_tech')]->getLevel(),
                    $data->getFleetList()[$units->getUnitID('solar_satellite')]->getAmount(),
                    $data->getPlanet()->getTempMax()
                );

                $prod_energy_total = 0;

                if ($data->getBuildingList()['metal_mine'] > 0) {
                    $energy = -$units->getEnergyConsumption($data->getBuildingList()['metal_mine']);
                    $prod_energy_total += $energy;

                    $lang_row['building_id'] = $units->getUnit(1);
                    $lang_row['building_name'] = $units->getName(1);
                    $lang_row['building_production_metal'] = number_format($prod_metal, 0);
                    $lang_row['building_production_crystal'] = 0;
                    $lang_row['building_production_deuterium'] = 0;
                    $lang_row['building_production_energy'] = number_format($energy, 0);
                    $lang_row['building_level'] = $data->getBuildingList()->getMetalMine();

                    $lang_row['production_options'] = $this->generateProductionOptions($units->getUnit(1),
                        $data->getPlanet()->getMetalMinePercent());
                    $this->view->assign('lang', $lang_row);

                    $this->lang['resource_row'] .= $this->view->loadResourceRow();
                }

                if ($data->getBuildingList()['crystal_mine'] > 0) {
                    $energy = -$units->getEnergyConsumption($data->getBuildingList()->getCrystalMine());
                    $prod_energy_total += $energy;

                    $lang_row['building_id'] = $units->getUnit(2);
                    $lang_row['building_name'] = $units->getName(2);
                    $lang_row['building_production_metal'] = 0;
                    $lang_row['building_production_crystal'] = number_format($prod_crystal, 0);
                    $lang_row['building_production_deuterium'] = 0;
                    $lang_row['building_production_energy'] = number_format($energy, 0);
                    $lang_row['building_level'] = $data->getBuildingList()->getCrystalMine();

                    $lang_row['production_options'] = $this->generateProductionOptions($units->getUnit(2),
                        $data->getPlanet()->getCrystalMinePercent());

                    $this->view->assign('lang', $lang_row);

                    $this->lang['resource_row'] .= $this->view->loadResourceRow();
                }

                if ($data->getBuildingList()['deuterium_synthesizer'] > 0) {
                    $energy = -$units->getEnergyConsumption($data->getBuildingList()->getDeuteriumSynthesizer());
                    $prod_energy_total += $energy;

                    $lang_row['building_id'] = $units->getUnit(3);
                    $lang_row['building_name'] = $units->getName(3);
                    $lang_row['building_production_metal'] = 0;
                    $lang_row['building_production_crystal'] = 0;
                    $lang_row['building_production_deuterium'] = number_format($prod_deuterium, 0);
                    $lang_row['building_production_energy'] = number_format($energy, 0);

                    $lang_row['building_level'] = $data->getBuildingList()->getDeuteriumSynthesizer();

                    $lang_row['production_options'] = $this->generateProductionOptions($units->getUnit(3),
                        $data->getPlanet()->getDeuteriumSynthesizerPercent());

                    $this->view->assign('lang', $lang_row);

                    $this->lang['resource_row'] .= $this->view->loadResourceRow();
                }

                if ($data->getBuildingList()['solar_plant'] > 0) {
                    $energy = $prod_energy_array['solar_plant'];
                    $prod_energy_total += $energy;

                    $lang_row['building_id'] = 'solar_plant';
                    $lang_row['building_name'] = $units->getName($units->getUnitID('solar_plant'));
                    $lang_row['building_production_metal'] = 0;
                    $lang_row['building_production_crystal'] = 0;
                    $lang_row['building_production_deuterium'] = 0;
                    $lang_row['building_production_energy'] = number_format($energy, 0);
                    $lang_row['building_level'] = $data->getBuildingList()['solar_plant'];

                    $lang_row['production_options'] = $this->generateProductionOptions($units->getUnit(4),
                        $data->getPlanet()->getSolarPlantPercent());

                    $this->view->assign('lang', $lang_row);

                    $this->lang['resource_row'] .= $this->view->loadResourceRow();
                }

                if ($data->getBuildingList()['fusion_reactor'] > 0) {
                    $energy = $prod_energy_array[$units->getUnit(5)];
                    $prod_energy_total += $energy;

                    $lang_row['building_id'] = $units->getUnit(5);
                    $lang_row['building_name'] = $units->getName(5);
                    $lang_row['building_production_metal'] = 0;
                    $lang_row['building_production_crystal'] = 0;
                    $lang_row['building_production_deuterium'] = -10 * ($data->getPlanet()
                                ->getFusionReactorPercent() / 100) * pow(1.1,
                            ($data->getPlanet()->getFusionReactorPercent() / 100));
                    $lang_row['building_production_energy'] = number_format($energy, 0);

                    $lang_row['production_options'] = $this->generateProductionOptions($units->getUnit(5),
                        $data->getPlanet()->getFusionReactorPercent());

                    $lang_row['building_level'] = $data->getBuildingList()->getSolarPlant();

                    $this->view->assign('lang', $lang_row);

                    $this->lang['resource_row'] .= $this->view->loadResourceRow();
                }

                if ($data->getFleetList()['solar_satellite'] > 0) {
                    $energy = $prod_energy_array[$units->getUnit(211)];
                    $prod_energy_total += $energy;

                    $lang_row['building_name'] = $units->getName(211);
                    $lang_row['building_production_metal'] = 0;
                    $lang_row['building_production_crystal'] = 0;
                    $lang_row['building_production_deuterium'] = 0;
                    $lang_row['building_production_energy'] = number_format($energy, 0);
                    $lang_row['building_level'] = $data->getFleetList()->getSolarSatellite();

                    $lang_row['production_options'] = $this->generateProductionOptions($units->getUnit(211),
                        $data->getPlanet()->getSolarSatellitePercent());

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

            global $data;
            if (!empty($this->get['cp'])) {
                $data->getUser()->setCurrentPlanet(intval($this->get['cp']));
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
                $this->view->assign('skinpath',Config::$gameConfig['skinpath']);
                $this->view->assign('copyright', Config::$gameConfig['copyright']);
                $this->view->assign('language', Config::$pathConfig['language']);

                die($this->view->loadTemplate());

            } catch (Exception $e) {
                if (DEBUG) {
                    $debug->addLog(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                } else {
                    $debug->saveError(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                }
            }
        }
    }
