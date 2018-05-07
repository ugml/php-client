<?php

    declare(strict_types=1);

    if (!defined('INSIDE')) {
        define('INSIDE', true);
    }

    require_once dirname(dirname(dirname(__FILE__))) . '/config.php';

    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/data/units.php";

    use PHPUnit\Framework\TestCase;

    /**
     * Class DataPlanetTest
     * @covers D_Units::__construct
     * @codeCoverageIgnore
     */
    final class DataUnitsTest extends TestCase {

        private $units;

        protected function setUp() : void {
            $this->units = new D_Units();
        }

        /**
         * @covers D_Units::getUnitID
         */
        public function testGetUnitID() : void {
            $this->assertSame(1, $this->units->getUnitID("metal_mine"));
            $this->assertSame(2, $this->units->getUnitID("crystal_mine"));
            $this->assertSame(3, $this->units->getUnitID("deuterium_synthesizer"));
            $this->assertSame(4, $this->units->getUnitID("solar_plant"));
            $this->assertSame(5, $this->units->getUnitID("fusion_reactor"));
            $this->assertSame(6, $this->units->getUnitID("robotic_factory"));
            $this->assertSame(7, $this->units->getUnitID("nanite_factory"));
            $this->assertSame(8, $this->units->getUnitID("shipyard"));
            $this->assertSame(9, $this->units->getUnitID("metal_storage"));
            $this->assertSame(10, $this->units->getUnitID("crystal_storage"));
            $this->assertSame(11, $this->units->getUnitID("deuterium_storage"));
            $this->assertSame(12, $this->units->getUnitID("research_lab"));
            $this->assertSame(13, $this->units->getUnitID("terraformer"));
            $this->assertSame(14, $this->units->getUnitID("alliance_depot"));
            $this->assertSame(15, $this->units->getUnitID("missile_silo"));
            $this->assertSame(101, $this->units->getUnitID("espionage_tech"));
            $this->assertSame(102, $this->units->getUnitID("computer_tech"));
            $this->assertSame(103, $this->units->getUnitID("weapon_tech"));
            $this->assertSame(104, $this->units->getUnitID("armour_tech"));
            $this->assertSame(105, $this->units->getUnitID("shielding_tech"));
            $this->assertSame(106, $this->units->getUnitID("energy_tech"));
            $this->assertSame(107, $this->units->getUnitID("hyperspace_tech"));
            $this->assertSame(108, $this->units->getUnitID("combustion_drive_tech"));
            $this->assertSame(109, $this->units->getUnitID("impulse_drive_tech"));
            $this->assertSame(110, $this->units->getUnitID("hyperspace_drive_tech"));
            $this->assertSame(111, $this->units->getUnitID("laser_tech"));
            $this->assertSame(112, $this->units->getUnitID("ion_tech"));
            $this->assertSame(113, $this->units->getUnitID("plasma_tech"));
            $this->assertSame(114, $this->units->getUnitID("intergalactic_research_tech"));
            $this->assertSame(115, $this->units->getUnitID("graviton_tech"));
            $this->assertSame(201, $this->units->getUnitID("small_cargo_ship"));
            $this->assertSame(202, $this->units->getUnitID("large_cargo_ship"));
            $this->assertSame(203, $this->units->getUnitID("light_fighter"));
            $this->assertSame(204, $this->units->getUnitID("heavy_fighter"));
            $this->assertSame(205, $this->units->getUnitID("cruiser"));
            $this->assertSame(206, $this->units->getUnitID("battleship"));
            $this->assertSame(207, $this->units->getUnitID("colony_ship"));
            $this->assertSame(208, $this->units->getUnitID("recycler"));
            $this->assertSame(209, $this->units->getUnitID("espionage_probe"));
            $this->assertSame(210, $this->units->getUnitID("bomber"));
            $this->assertSame(211, $this->units->getUnitID("solar_satellite"));
            $this->assertSame(212, $this->units->getUnitID("destroyer"));
            $this->assertSame(213, $this->units->getUnitID("battlecruiser"));
            $this->assertSame(214, $this->units->getUnitID("deathstar"));
            $this->assertSame(301, $this->units->getUnitID("rocket_launcher"));
            $this->assertSame(302, $this->units->getUnitID("light_laser"));
            $this->assertSame(303, $this->units->getUnitID("heavy_laser"));
            $this->assertSame(304, $this->units->getUnitID("gauss_cannon"));
            $this->assertSame(305, $this->units->getUnitID("ion_cannon"));
            $this->assertSame(306, $this->units->getUnitID("plasma_turret"));
            $this->assertSame(307, $this->units->getUnitID("small_shield_dome"));
            $this->assertSame(308, $this->units->getUnitID("large_shield_dome"));
            $this->assertSame(309, $this->units->getUnitID("anti_ballistic_missile"));
            $this->assertSame(310, $this->units->getUnitID("interplanetary_missile"));
        }

        /**
         * @covers D_Units::getUnitName
         */
        public function testGetUnitName() : void {
            $this->assertSame("metal_mine", $this->units->getUnitName(1));
            $this->assertSame("crystal_mine", $this->units->getUnitName(2));
            $this->assertSame("deuterium_synthesizer", $this->units->getUnitName(3));
            $this->assertSame("solar_plant", $this->units->getUnitName(4));
            $this->assertSame("fusion_reactor", $this->units->getUnitName(5 ));
            $this->assertSame("robotic_factory", $this->units->getUnitName(6));
            $this->assertSame("nanite_factory", $this->units->getUnitName(7));
            $this->assertSame("shipyard", $this->units->getUnitName(8));
            $this->assertSame("metal_storage", $this->units->getUnitName(9));
            $this->assertSame("crystal_storage", $this->units->getUnitName(10));
            $this->assertSame("deuterium_storage", $this->units->getUnitName(11));
            $this->assertSame("research_lab", $this->units->getUnitName(12));
            $this->assertSame("terraformer", $this->units->getUnitName(13));
            $this->assertSame("alliance_depot", $this->units->getUnitName(14));
            $this->assertSame("missile_silo", $this->units->getUnitName(15));
            $this->assertSame("espionage_tech", $this->units->getUnitName(101));
            $this->assertSame("computer_tech", $this->units->getUnitName(102));
            $this->assertSame("weapon_tech", $this->units->getUnitName(103));
            $this->assertSame("armour_tech", $this->units->getUnitName(104));
            $this->assertSame("shielding_tech", $this->units->getUnitName(105));
            $this->assertSame("energy_tech", $this->units->getUnitName(106));
            $this->assertSame("hyperspace_tech", $this->units->getUnitName(107 ));
            $this->assertSame("combustion_drive_tech", $this->units->getUnitName(108));
            $this->assertSame("impulse_drive_tech", $this->units->getUnitName(109));
            $this->assertSame("hyperspace_drive_tech", $this->units->getUnitName(110));
            $this->assertSame("laser_tech", $this->units->getUnitName(111));
            $this->assertSame("ion_tech", $this->units->getUnitName(112));
            $this->assertSame("plasma_tech", $this->units->getUnitName(113));
            $this->assertSame("intergalactic_research_tech", $this->units->getUnitName(114));
            $this->assertSame("graviton_tech", $this->units->getUnitName(115));
            $this->assertSame("small_cargo_ship", $this->units->getUnitName(201));
            $this->assertSame("large_cargo_ship", $this->units->getUnitName(202));
            $this->assertSame("light_fighter", $this->units->getUnitName(203));
            $this->assertSame("heavy_fighter", $this->units->getUnitName(204));
            $this->assertSame("cruiser", $this->units->getUnitName(205));
            $this->assertSame("battleship", $this->units->getUnitName(206));
            $this->assertSame("colony_ship", $this->units->getUnitName(207));
            $this->assertSame("recycler", $this->units->getUnitName(208));
            $this->assertSame("espionage_probe", $this->units->getUnitName(209));
            $this->assertSame("bomber", $this->units->getUnitName(210));
            $this->assertSame("solar_satellite", $this->units->getUnitName(211));
            $this->assertSame("destroyer", $this->units->getUnitName(212));
            $this->assertSame("battlecruiser", $this->units->getUnitName(213));
            $this->assertSame("deathstar", $this->units->getUnitName(214));
            $this->assertSame("rocket_launcher", $this->units->getUnitName(301));
            $this->assertSame("light_laser", $this->units->getUnitName(302));
            $this->assertSame("heavy_laser", $this->units->getUnitName(303));
            $this->assertSame("gauss_cannon", $this->units->getUnitName(304));
            $this->assertSame("ion_cannon", $this->units->getUnitName(305));
            $this->assertSame("plasma_turret", $this->units->getUnitName(306));
            $this->assertSame("small_shield_dome", $this->units->getUnitName(307));
            $this->assertSame("large_shield_dome", $this->units->getUnitName(308));
            $this->assertSame("anti_ballistic_missile", $this->units->getUnitName(309));
            $this->assertSame("interplanetary_missile", $this->units->getUnitName(310));
        }

        /**
         * @covers D_Units::getBuildings
         */
        public function testGetBuildings() : void {

            $expected = [1  => 'metal_mine',
                         2  => 'crystal_mine',
                         3  => 'deuterium_synthesizer',
                         4  => 'solar_plant',
                         5  => 'fusion_reactor',
                         6  => 'robotic_factory',
                         7  => 'nanite_factory',
                         8  => 'shipyard',
                         9  => 'metal_storage',
                         10 => 'crystal_storage',
                         11 => 'deuterium_storage',
                         12 => 'research_lab',
                         13 => 'terraformer',
                         14 => 'alliance_depot',
                         15 => 'missile_silo'];

            $this->assertSame($expected, $this->units->getBuildings());
        }

        /**
         * @covers D_Units::getTechnologies
         */
        public function testGetTechnologies() : void {

            $expected = [101 => 'espionage_tech',
                         102 => 'computer_tech',
                         103 => 'weapon_tech',
                         104 => 'armour_tech',
                         105 => 'shielding_tech',
                         106 => 'energy_tech',
                         107 => 'hyperspace_tech',
                         108 => 'combustion_drive_tech',
                         109 => 'impulse_drive_tech',
                         110 => 'hyperspace_drive_tech',
                         111 => 'laser_tech',
                         112 => 'ion_tech',
                         113 => 'plasma_tech',
                         114 => 'intergalactic_research_tech',
                         115 => 'graviton_tech'];

            $this->assertSame($expected, $this->units->getTechnologies());
        }

        /**
         * @covers D_Units::getFleet
         */
        public function testGetFleet() : void {

            $expected = [201 => 'small_cargo_ship',
                         202 => 'large_cargo_ship',
                         203 => 'light_fighter',
                         204 => 'heavy_fighter',
                         205 => 'cruiser',
                         206 => 'battleship',
                         207 => 'colony_ship',
                         208 => 'recycler',
                         209 => 'espionage_probe',
                         210 => 'bomber',
                         211 => 'solar_satellite',
                         212 => 'destroyer',
                         213 => 'battlecruiser',
                         214 => 'deathstar'];

            $this->assertSame($expected, $this->units->getFleet());
        }

        /**
         * @covers D_Units::getDefense
         */
        public function testGetDefense() : void {

            $expected = [301 => 'rocket_launcher',
                         302 => 'light_laser',
                         303 => 'heavy_laser',
                         304 => 'gauss_cannon',
                         305 => 'ion_cannon',
                         306 => 'plasma_turret',
                         307 => 'small_shield_dome',
                         308 => 'large_shield_dome',
                         309 => 'anti_ballistic_missile',
                         310 => 'interplanetary_missile'];

            $this->assertSame($expected, $this->units->getDefense());
        }

        /**
         * @covers D_Units::getName
         */
        public function testGetName() : void {
            $this->assertSame("Metal Mine", $this->units->getName(1));
        }

        /**
         * @covers D_Units::getDescription
         */
        public function testGetDescription() : void {
            $this->assertSame("Metal is the main resource for conducting research and the construction of buildings, ships, and defensive units.", $this->units->getDescription(1));
        }

        /**
         * @covers D_Units::getPriceList
         */
        public function testGetPricelist() : void {
            $this->assertSame(['metal' => 60, 'crystal' => 15, 'deuterium' => 0, 'energy' => 0, 'factor' => 1.5], $this->units->getPriceList(1));
        }

        /**
         * @covers D_Units::getRequirements
         */
        public function testGetRequirements() : void {
            $this->assertSame([12 => 7, 106 => 5, 105 => 5], $this->units->getRequirements(107));
            $this->assertSame([], $this->units->getRequirements(99999999));
        }

        /**
         * @covers D_Units::getBuildTime
         */
        public function testGetBuildTimeBuilding() : void {

            $building = new U_Building(1,0, 60, 15, 0, 0, 1.5);


            $this->assertSame(108.0, $this->units->getBuildTime($building, 0, 0, 0) * 3600);
        }

        /**
         * @covers D_Units::getBuildTime
         */
        public function testGetBuildTimeTech() : void {

            $research = new U_Research(101,0, 200, 100, 200, 0, 2);


            $this->assertSame(864.0, $this->units->getBuildTime($research, 0, 0, 0) * 3600);
        }

        /**
         * @covers D_Units::getBuildTime
         */
        public function testGetBuildTimeFleetOrDefense() : void {

            $fleet = new U_Fleet(201,0, 2000, 2000, 0, 0, 1);

            $this->assertSame(5760.0, $this->units->getBuildTime($fleet, 0, 0, 0) * 3600);
        }

        /**
         * @covers D_Units::getStorageCapacity
         */
        public function testGetStorageCapacity() : void {

            $level = 5;

            $this->assertSame(100000 + 50000 * (ceil(pow(1.5, $level)) - 1), $this->units->getStorageCapacity($level));

        }

        /**
         * @covers D_Units::getMetalProductionPerHour
         */
        public function testGetMetalProductionPerHour() : void {

            $level = 12;

            $this->assertSame(10 * $level * pow(1.1, $level), $this->units->getMetalProductionPerHour($level));
        }

        /**
         * @covers D_Units::getCrystalProductionPerHour
         */
        public function testGetCrystalProductionPerHour() : void {

            $level = 5;

            $this->assertSame(10 * $level * pow(1.1, $level), $this->units->getCrystalProductionPerHour($level));
        }

        /**
         * @covers D_Units::getDeuteriumProductionPerHour
         */
        public function testGetDeuteriumProductionPerHour() : void {

            $level = 8;

            $this->assertSame(10 * $level * pow(1.1, $level), $this->units->getDeuteriumProductionPerHour($level));
        }

        /**
         * @covers D_Units::getEnergyProduction
         */
        public function testGetEnergyProduction() : void {

            $this->assertSame(['solar_plant' => 22.0,
                                'fusion_reactor' => 61.79999999999999,
                                'solar_satellite' => 20.25], $this->units->getEnergyProduction(1,1,1,1,1));
        }

        /**
         * @covers D_Units::getEnergyConsumption
         */
        public function testGetEnergyConsumption() : void {

            $level = 13;

            $this->assertSame(10 * $level * pow(1.1, $level), $this->units->getEnergyConsumption($level));
        }

    }
