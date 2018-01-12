<?php

    // the user is logged in, so we allow
    // script-access within the game
    define('INSIDE', true);

    // load the server-configuration
    require('core/config.php');

    try {
        $db = new PDO('mysql:host=' . $database['host'] . ';dbname=' . $database['dbname'], $database['user'],
            $database['pass']);

        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = 'SELECT 
                    user.userID AS user_userID,
                    planet.planetID AS planet_planetID,
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
                    tech.combustion_tech AS tech_combustion_tech,
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
                    FROM ' . $database['prefix'] . 'users AS user 
                    LEFT JOIN ' . $database['prefix'] . 'planets AS planet ON planet.ownerID = user.userID
                    LEFT JOIN ' . $database['prefix'] . 'buildings AS building ON planet.planetID = building.planetID
                    LEFT JOIN ' . $database['prefix'] . 'defenses AS defense ON planet.planetID = defense.planetID
                    LEFT JOIN ' . $database['prefix'] . 'techs AS tech ON user.userID = tech.userID
                    LEFT JOIN ' . $database['prefix'] . 'fleet AS fleet ON planet.planetID = fleet.planetID;';

        $stmt = $db->prepare($query);

        $stmt->execute();

        require $path['classes'] . 'units.class.php';

        $units = new Units();

        $userPoints = [];

        while ($f = $stmt->fetch()) {
            $userID = -1;
            $points_buildings = 0;
            $points_tech = 0;
            $points_fleet = 0;
            $points_defense = 0;


            foreach ($f as $k => $v) {
                switch ($k) {
                    // get the userID
                    case (preg_match('#^user#', $k) === 1):
                        if ($k === 'user_userID') {
                            $userID = $v;
                        }
                        break;

                    // calculate points for building
                    case (preg_match('#^building#', $k) === 1):
                        // if unit exists / has been built
                        if ($v > 0) {

                            // get the unitID
                            $unitID = $units->getUnitID(substr($k, strlen('building_')));

                            // get the pricelist
                            $pricelist = $units->getPriceList($unitID);

                            $sum = 0;

                            // get the baseprice
                            $metal = $pricelist['metal'];
                            $crystal = $pricelist['crystal'];
                            $deuterium = $pricelist['deuterium'];

                            // calculate the total costs up to this level
                            for ($i = 0; $i < $v; $i++) {
                                $sum += $metal + $crystal + $deuterium;
                                $metal *= $pricelist['factor'];
                                $crystal *= $pricelist['factor'];
                                $deuterium *= $pricelist['factor'];
                            }

                            $points_buildings += $sum / 1000;
                        }
                        if ($k === 'user_userID') {
                            $userID = $v;
                        }
                        break;

                    // calculate points for the techs
                    case (preg_match('#^tech#', $k) === 1):
                        // if unit exists / has been built
                        if ($v > 0) {

                            // get the unitID
                            $unitID = $units->getUnitID(substr($k, strlen('tech_')));

                            // get the pricelist
                            $pricelist = $units->getPriceList($unitID);

                            $sum = 0;

                            // get the baseprice
                            $metal = $pricelist['metal'];
                            $crystal = $pricelist['crystal'];
                            $deuterium = $pricelist['deuterium'];

                            // calculate the total costs up to this level
                            for ($i = 0; $i < $v; $i++) {
                                $sum += $metal + $crystal + $deuterium;
                                $metal *= $pricelist['factor'];
                                $crystal *= $pricelist['factor'];
                                $deuterium *= $pricelist['factor'];
                            }

                            $points_tech += $sum / 1000;
                        }
                        if ($k === 'user_userID') {
                            $userID = $v;
                        }
                        break;

                    // calculate points for the techs
                    case (preg_match('#^defense#', $k) === 1):
                        // if unit exists / has been built
                        if ($v > 0) {

                            // get the unitID
                            $unitID = $units->getUnitID(substr($k, strlen('defense_')));

                            // get the pricelist
                            $pricelist = $units->getPriceList($unitID);

                            $sum = 0;

                            // get the baseprice
                            $metal = $pricelist['metal'] * $v;
                            $crystal = $pricelist['crystal'] * $v;
                            $deuterium = $pricelist['deuterium'] * $v;


                            $points_defense += ($metal + $crystal + $deuterium) / 1000;
                        }
                        if ($k === 'user_userID') {
                            $userID = $v;
                        }
                        break;

                    // calculate points for the techs
                    case (preg_match('#^fleet#', $k) === 1):
                        // if unit exists / has been built
                        if ($v > 0) {

                            // get the unitID
                            $unitID = $units->getUnitID(substr($k, strlen('fleet_')));

                            // get the pricelist
                            $pricelist = $units->getPriceList($unitID);

                            $sum = 0;

                            // get the baseprice
                            $metal = $pricelist['metal'] * $v;
                            $crystal = $pricelist['crystal'] * $v;
                            $deuterium = $pricelist['deuterium'] * $v;


                            $points_fleet += ($metal + $crystal + $deuterium) / 1000;
                        }
                        if ($k === 'user_userID') {
                            $userID = $v;
                        }
                        break;
                }
            }

            if (array_key_exists($userID, $userPoints)) {
                $userPoints[$userID]['points_buildings'] += $points_buildings;
                $userPoints[$userID]['points_tech'] += $points_tech;
                $userPoints[$userID]['points_defense'] += $points_defense;
                $userPoints[$userID]['points_fleet'] += $points_fleet;

            } else {
                $userPoints[$userID] = ['points_buildings' => $points_buildings,
                                        'points_tech'      => $points_tech,
                                        'points_fleet'     => $points_fleet,
                                        'points_defense'   => $points_defense
                ];
            }
        }

        /*$query = 'UPDATE '.$database['prefix'].'statistics SET points_total = :points_total, points_buildings = :points_buildings, points_tech = :points_tech, points_fleet = :points_fleet, points_defense = :points_defense WHERE userID = :userID';

        $stmt = $db->prepare($query);

        $sum = $userPoints[$userID]['points_buildings'] + $userPoints[$userID]['points_tech'] + $userPoints[$userID]['points_fleet'] + $userPoints[$userID]['points_defense'];

        $stmt->bindParam(':userID',$userID);
        $stmt->bindParam(':points_total',$sum);
        $stmt->bindParam(':points_buildings',$userPoints[$userID]['points_buildings']);
        $stmt->bindParam(':points_tech',$userPoints[$userID]['points_tech']);
        $stmt->bindParam(':points_fleet',$userPoints[$userID]['points_fleet']);
        $stmt->bindParam(':points_defense',$userPoints[$userID]['points_defense']);

        $stmt->execute();*/

        echo "<pre>";
        print_r($userPoints);
        die();

    } catch (Exception $e) {
        $debug->saveError('points.php', 'points.php', __LINE__, get_class($e), $e->getMessage());
    }

    echo '--- done ---';
