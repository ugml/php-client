<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class Loader {

        private $user = null;

        private $planet = null;

        private $galaxy = null;

        private $buildingData;
        private $buildingList = [];

        private $defenseData;
        private $defenseList = [];

        private $techData;
        private $techList = [];

        private $fleetData;
        private $fleetList = [];

        /**
         * Loader constructor.
         * @param $userID
         */
        function __construct($userID) {

            global $dbConfig, $dbConnection, $units;

            // get all data from the database
            $query = 'SELECT
                        user.userID AS user_userID,
                        user.username AS user_username,
                        user.email AS user_email,
                        user.onlinetime AS user_onlinetime,
                        user.currentplanet AS user_currentplanet,
                        stats.points AS user_points,
                        stats.old_rank AS user_old_rank,
                        stats.rank AS user_rank,
                        planet.planetID AS planet_planetID,
                        planet.name AS planet_name,
                        planet.galaxy AS planet_galaxy,
                        planet.system AS planet_system,
                        planet.planet AS planet_planet,
                        planet.last_update AS planet_last_update,
                        planet.planet_type AS planet_type,
                        planet.image AS planet_image,
                        planet.diameter AS planet_diameter,
                        planet.fields_current AS planet_fields_current,
                        planet.fields_max AS planet_fields_max,
                        planet.temp_min AS planet_temp_min,
                        planet.temp_max AS planet_temp_max,
                        planet.metal AS planet_metal,
                        planet.crystal AS planet_crystal,
                        planet.deuterium AS planet_deuterium,
                        planet.energy_used AS planet_energy_used,
                        planet.energy_max AS planet_energy_max,
                        planet.metal_mine_percent AS planet_metal_mine_percent,
                        planet.crystal_mine_percent AS planet_crystal_mine_percent,
                        planet.deuterium_synthesizer_percent AS planet_deuterium_synthesizer_percent,
                        planet.solar_plant_percent AS planet_solar_plant_percent,
                        planet.fusion_reactor_percent AS planet_fusion_reactor_percent,
                        planet.solar_satellite_percent AS planet_solar_satellite_percent,
                        planet.b_building_id AS planet_b_building_id,
                        planet.b_building_endtime AS planet_b_building_endtime,
                        planet.b_tech_id AS planet_b_tech_id,
                        planet.b_tech_endtime AS planet_b_tech_endtime,
                        planet.b_hangar_start_time AS planet_b_hangar_start_time,
                        planet.b_hangar_id AS planet_b_hangar_id,
                        planet.b_hangar_plus AS planet_b_hangar_plus,
                        planet.destroyed AS planet_destroyed,
                        galaxy.debris_metal AS galaxy_debris_metal,
                        galaxy.debris_crystal AS galaxy_debris_crystal,
                        building.metal_mine AS building_metal_mine,
                        building.crystal_mine AS building_crystal_mine,
                        building.deuterium_synthesizer AS building_deuterium_synthesizer,
                        building.solar_plant AS building_solar_plant,
                        building.fusion_reactor AS building_fusion_reactor,
                        building.robotic_factory AS building_robotic_factory,
                        building.nanite_factory AS building_nanite_factory,
                        building.shipyard AS building_shipyard,
                        building.metal_storage AS building_metal_storage,
                        building.crystal_storage AS building_crystal_storage,
                        building.deuterium_storage AS building_deuterium_storage,
                        building.research_lab AS building_research_lab,
                        building.terraformer AS building_terraformer,
                        building.alliance_depot AS building_alliance_depot,
                        building.missile_silo AS building_missile_silo,
                        defense.rocket_launcher AS defense_rocket_launcher,
                        defense.light_laser AS defense_light_laser,
                        defense.heavy_laser AS defense_heavy_laser,
                        defense.ion_cannon AS defense_ion_cannon,
                        defense.gauss_cannon AS defense_gauss_cannon,
                        defense.plasma_turret AS defense_plasma_turret,
                        defense.small_shield_dome AS defense_small_shield_dome,
                        defense.large_shield_dome AS defense_large_shield_dome,
                        defense.anti_ballistic_missile AS defense_anti_ballistic_missile,
                        defense.interplanetary_missile AS defense_interplanetary_missile,
                        tech.espionage_tech AS tech_espionage_tech,
                        tech.computer_tech AS tech_computer_tech,
                        tech.weapon_tech AS tech_weapon_tech,
                        tech.armour_tech AS tech_armour_tech,
                        tech.shielding_tech AS tech_shielding_tech,
                        tech.energy_tech AS tech_energy_tech,
                        tech.hyperspace_tech AS tech_hyperspace_tech,
                        tech.combustion_drive_tech AS tech_combustion_tech,
                        tech.impulse_drive_tech AS tech_impulse_drive_tech,
                        tech.hyperspace_drive_tech AS tech_hyperspace_drive_tech,
                        tech.laser_tech AS tech_laser_tech,
                        tech.ion_tech AS tech_ion_tech,
                        tech.plasma_tech AS tech_plasma_tech,
                        tech.intergalactic_research_tech AS tech_intergalactic_research_tech,
                        tech.graviton_tech AS tech_graviton_tech,
                        fleet.small_cargo_ship AS fleet_small_cargo_ship,
                        fleet.large_cargo_ship AS fleet_large_cargo_ship,
                        fleet.light_fighter AS fleet_light_fighter,
                        fleet.heavy_fighter AS fleet_heavy_fighter,
                        fleet.cruiser AS fleet_cruiser,
                        fleet.battleship AS fleet_battleship,
                        fleet.colony_ship AS fleet_colony_ship,
                        fleet.recycler AS fleet_recycler,
                        fleet.espionage_probe AS fleet_espionage_probe,
                        fleet.bomber AS fleet_bomber,
                        fleet.solar_satellite AS fleet_solar_satellite,
                        fleet.destroyer AS fleet_destroyer,
                        fleet.battlecruiser AS fleet_battlecruiser,
                        fleet.deathstar AS fleet_deathstar
                        FROM ' . $dbConfig['prefix'] . 'users AS user
                        LEFT JOIN ' . $dbConfig['prefix'] . 'stats AS stats ON user.userID = stats.userID
                        LEFT JOIN ' . $dbConfig['prefix'] . 'planets AS planet ON user.userID = planet.ownerID
                        LEFT JOIN ' . $dbConfig['prefix'] . 'galaxy AS galaxy ON planet.planetID = galaxy.planetID
                        LEFT JOIN ' . $dbConfig['prefix'] . 'buildings AS building ON planet.planetID = building.planetID
                        LEFT JOIN ' . $dbConfig['prefix'] . 'defenses AS defense ON planet.planetID = defense.planetID
                        LEFT JOIN ' . $dbConfig['prefix'] . 'techs AS tech ON user.userID = tech.userID
                        LEFT JOIN ' . $dbConfig['prefix'] . 'fleet AS fleet ON planet.planetID = fleet.planetID
                        WHERE user.userID = :userID;';

            $stmt = $dbConnection->prepare($query);

            $stmt->bindParam(':userID', $userID);

            $stmt->execute();

            $planetList = [];

            // process data and store it in objects
            while ($data = $stmt->fetch()) {

                $planet = new U_Planet(
                    intval($data->planet_planetID),
                    intval($userID),
                    $data->planet_name,
                    intval($data->planet_galaxy),
                    intval($data->planet_system),
                    intval($data->planet_planet),
                    intval($data->planet_last_update),
                    intval($data->planet_type),
                    $data->planet_image,
                    intval($data->planet_diameter),
                    intval($data->planet_fields_current),
                    intval($data->planet_fields_max),
                    intval($data->planet_temp_min),
                    intval($data->planet_temp_max),
                    floatval($data->planet_metal),
                    floatval($data->planet_crystal),
                    floatval($data->planet_deuterium),
                    intval($data->planet_energy_used),
                    intval($data->planet_energy_max),
                    intval($data->planet_metal_mine_percent),
                    intval($data->planet_crystal_mine_percent),
                    intval($data->planet_deuterium_synthesizer_percent),
                    intval($data->planet_solar_plant_percent),
                    intval($data->planet_fusion_reactor_percent),
                    intval($data->planet_solar_satellite_percent),
                    intval($data->planet_b_building_id),
                    intval($data->planet_b_building_endtime),
                    intval($data->planet_b_tech_id),
                    intval($data->planet_b_tech_endtime),
                    intval($data->planet_b_hangar_start_time),
                    (isset($data->planet_b_hangar_id) ? $data->planet_b_hangar_id : ""),
                    boolval($data->planet_b_hangar_plus),
                    boolval($data->planet_destroyed)
                );

                // current planet -> get buildings / tech / fleet / defense
                if ($data->user_currentplanet == $data->planet_planetID) {

                    //int $points, int $cRank, int $oRank
                    $this->user = new D_User(
                        intval($userID),
                        $data->user_username,
                        $data->user_email,
                        intval($data->user_onlinetime),
                        intval($data->user_currentplanet),
                        intval($data->user_points),
                        intval($data->user_rank),
                        intval($data->user_rank_old)
                    );


                    // data about all building-levels from the database
                    $dBuilding = [
                        intval($data->building_metal_mine),
                        intval($data->building_crystal_mine),
                        intval($data->building_deuterium_synthesizer),
                        intval($data->building_solar_plant),
                        intval($data->building_fusion_reactor),
                        intval($data->building_robotic_factory),
                        intval($data->building_nanite_factory),
                        intval($data->building_shipyard),
                        intval($data->building_metal_storage),
                        intval($data->building_crystal_storage),
                        intval($data->building_deuterium_storage),
                        intval($data->building_research_lab),
                        intval($data->building_terraformer),
                        intval($data->building_alliance_depot),
                        intval($data->building_missile_silo)
                    ];

                    $dDefense = [intval($data->defense_rocket_launcher),
                                 intval($data->defense_light_laser),
                                 intval($data->defense_heavy_laser),
                                 intval($data->defense_ion_cannon),
                                 intval($data->defense_gauss_cannon),
                                 intval($data->defense_plasma_turret),
                                 intval($data->defense_small_shield_dome),
                                 intval($data->defense_large_shield_dome),
                                 intval($data->defense_anti_ballistic_missile),
                                 intval($data->defense_interplanetary_missile)
                    ];

                    $dFleet = [intval($data->fleet_small_cargo_ship),
                               intval($data->fleet_large_cargo_ship),
                               intval($data->fleet_light_fighter),
                               intval($data->fleet_heavy_fighter),
                               intval($data->fleet_cruiser),
                               intval($data->fleet_battleship),
                               intval($data->fleet_colony_ship),
                               intval($data->fleet_recycler),
                               intval($data->fleet_espionage_probe),
                               intval($data->fleet_bomber),
                               intval($data->fleet_solar_satellite),
                               intval($data->fleet_destroyer),
                               intval($data->fleet_battlecruiser),
                               intval($data->fleet_deathstar)
                    ];

                    $dResearch = [intval($data->tech_espionage_tech),
                                  intval($data->tech_computer_tech),
                                  intval($data->tech_weapon_tech),
                                  intval($data->tech_armour_tech),
                                  intval($data->tech_shielding_tech),
                                  intval($data->tech_energy_tech),
                                  intval($data->tech_hyperspace_tech),
                                  intval($data->tech_combustion_drive_tech),
                                  intval($data->tech_impulse_drive_tech),
                                  intval($data->tech_hyperspace_drive_tech),
                                  intval($data->tech_laser_tech),
                                  intval($data->tech_ion_tech),
                                  intval($data->tech_plasma_tech),
                                  intval($data->tech_intergalactic_research_tech),
                                  intval($data->tech_graviton_tech)
                    ];


                    $this->buildingData = new D_Building(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);

                    // create a building-object for each building
                    for ($i = 1; $i <= count($dBuilding); $i++) {

                        $this->buildingData->setBuildingByID($i, $dBuilding[$i - 1]);

                        $this->buildingList[$i] = new U_Building(
                            $i,
                            $dBuilding[$i - 1],
                            $units->getPriceList($i)['metal'],
                            $units->getPriceList($i)['crystal'],
                            $units->getPriceList($i)['deuterium'],
                            $units->getPriceList($i)['energy'],
                            $units->getPriceList($i)['factor']
                        );
                    }

                    $this->techData = new D_Tech(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);

                    // create a research-object for each defense
                    for ($i = 1; $i <= count($dResearch); $i++) {
                        //$uID, $uLevel, $uCostMetal, $uCostCrystal, $uCostDeuterium, $uCostEnergy, $uCostFactor

                        //TODO set techData

                        $this->techList[$i + 100] = new U_Research(
                            $i,
                            $dResearch[$i - 1],
                            $units->getPriceList($i)['metal'],
                            $units->getPriceList($i)['crystal'],
                            $units->getPriceList($i)['deuterium'],
                            $units->getPriceList($i)['energy'],
                            $units->getPriceList($i)['factor']
                        );
                    }

                    // create a fleet-object for each defense
                    for ($i = 1; $i <= count($dFleet); $i++) {
                        //$uID, $uLevel, $uCostMetal, $uCostCrystal, $uCostDeuterium, $uCostEnergy, $uCostFactor

                        $this->fleetList[$i + 200] = new U_Fleet(
                            $i,
                            $dFleet[$i - 1],
                            $units->getPriceList($i)['metal'],
                            $units->getPriceList($i)['crystal'],
                            $units->getPriceList($i)['deuterium'],
                            $units->getPriceList($i)['energy'],
                            $units->getPriceList($i)['factor']
                        );
                    }

                    // create a fleet-object for each defense
                    for ($i = 1; $i <= count($dDefense); $i++) {
                        //$uID, $uLevel, $uCostMetal, $uCostCrystal, $uCostDeuterium, $uCostEnergy, $uCostFactor

                        $this->defenseList[$i + 300] = new U_Defense(
                            $i,
                            $dDefense[$i - 1],
                            $units->getPriceList($i)['metal'],
                            $units->getPriceList($i)['crystal'],
                            $units->getPriceList($i)['deuterium'],
                            $units->getPriceList($i)['energy'],
                            $units->getPriceList($i)['factor']
                        );
                    }

                    $this->galaxy = new D_Galaxy(intval($data->galaxy_debris_metal),
                        intval($data->galaxy_debris_crystal));

                    $this->planet = $planet;

                }


                array_push($planetList, $planet);

            }


            $this->user->setPlanetList($planetList);

            // update points
            $points = 0;

            // buildings
            foreach($dBuilding as $key => $level) {
                $pricelist = $units->getPriceList($key+1);

                //120 * (1,5 ^ X - 1,5 ^ Y)

                $metal = 0;
                $crystal = 0;
                $deuterium = 0;

                for($i = 0; $i < $level; $i++) {
                    $metal += $pricelist['metal'] * ($pricelist['factor'] ** $i);
                    $crystal += $pricelist['crystal'] * ($pricelist['factor'] ** $i);
                    $deuterium += $pricelist['deuterium'] * ($pricelist['factor'] ** $i);
                }

                $points += floor((round($metal, -3) + round($crystal , -3)+ round($deuterium, -3))/1000);
            }

            // tech
            foreach($dResearch as $key => $level) {
                $pricelist = $units->getPriceList($key+101);
                $metal = 0;
                $crystal = 0;
                $deuterium = 0;

                for($i = 0; $i < $level; $i++) {
                    $metal += $pricelist['metal'] * ($pricelist['factor'] ** $i);
                    $crystal += $pricelist['crystal'] * ($pricelist['factor'] ** $i);
                    $deuterium += $pricelist['deuterium'] * ($pricelist['factor'] ** $i);
                }

                $points += floor((round($metal, -3) + round($crystal , -3)+ round($deuterium, -3))/1000);
            }

            // fleet
            foreach($dFleet as $key => $level) {
                $pricelist = $units->getPriceList($key+201);

                $metal = $pricelist['metal'] * $level;
                $crystal = $pricelist['crystal'] * $level;
                $deuterium = $pricelist['deuterium'] * $level;


                $points += floor((round($metal, -3) + round($crystal , -3)+ round($deuterium, -3))/1000);
            }

            // defense
            foreach($dDefense as $key => $level) {
                $pricelist = $units->getPriceList($key+301);

                $metal = $pricelist['metal'] * $level;
                $crystal = $pricelist['crystal'] * $level;
                $deuterium = $pricelist['deuterium'] * $level;

                $points += floor((round($metal, -3) + round($crystal , -3)+ round($deuterium, -3))/1000);
            }

            $query = 'UPDATE ' . $dbConfig['prefix'] . 'stats SET points = '.$points.' WHERE userID = :userID;';

            $stmt = $dbConnection->prepare($query);

            $stmt->bindParam(':userID', $userID);

            $stmt->execute();


            // update onlinetime
            $query = 'UPDATE ' . $dbConfig['prefix'] . 'users SET onlinetime = '.time().' WHERE userID = :userID;';

            $stmt = $dbConnection->prepare($query);

            $stmt->bindParam(':userID', $userID);

            $stmt->execute();


            //            $functions = spl_autoload_functions();
            //            foreach ($functions as $function) {
            //                spl_autoload_unregister($function);
            //            }
        }

        public function printData() : void {

            echo '<pre>';
            print_r($this);
            echo '</pre>';
        }

        /**
         * @return D_User
         */
        public function getUser() : D_User {

            return $this->user;
        }

        /**
         * @return U_Planet
         */
        public function getPlanet() : U_Planet {

            return $this->planet;
        }

        /**
         * @return D_Galaxy
         */
        public function getGalaxy() : D_Galaxy {

            return $this->galaxy;
        }

        /**
         * @return D_Building
         */
        public function getBuildingList() : array {
            return $this->buildingList;
        }

        /**
         * @return D_Defense
         */
        public function getDefenseList() : array {

            return $this->defenseList;
        }

        /**
         * @return D_Tech
         */
        public function getTechList() : array {

            return $this->techList;
        }

        /**
         * @return D_Fleet
         */
        public function getFleetList() : array {

            return $this->fleetList;
        }

        /**
         * @return D_Building
         */
        public function getBuildingData() : D_Building {
            return $this->buildingData;
        }

        /**
         * @return mixed
         */
        public function getDefenseData() : D_Defense {
            return $this->defenseData;
        }

        /**
         * @return D_Tech
         */
        public function getTechData() : D_Tech {
            return $this->techData;
        }

        /**
         * @return mixed
         */
        public function getFleetData() : D_Fleet {
            return $this->fleetData;
        }


    }
