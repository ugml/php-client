<?php

    declare(strict_types = 1);

    use PHPUnit\Framework\TestCase;

    /**
     * Class DataPlanetTest
     * @covers D_Units::init()
     * @codeCoverageIgnore
     */
    final class DataUnitsTest extends TestCase {

        /**
         * @covers D_Units::destruct
         * @covers D_Units::init
         */
        protected function setUp() : void {
            D_Units::destruct();
            D_Units::init();
        }

        /**
         * @covers D_Units::getUnitID
         */
        public function testGetUnitID() : void {

            $this->assertSame(1, D_Units::getUnitID("metal_mine"));
            $this->assertSame(2, D_Units::getUnitID("crystal_mine"));
            $this->assertSame(3, D_Units::getUnitID("deuterium_synthesizer"));
            $this->assertSame(4, D_Units::getUnitID("solar_plant"));
            $this->assertSame(5, D_Units::getUnitID("fusion_reactor"));
            $this->assertSame(6, D_Units::getUnitID("robotic_factory"));
            $this->assertSame(7, D_Units::getUnitID("nanite_factory"));
            $this->assertSame(8, D_Units::getUnitID("shipyard"));
            $this->assertSame(9, D_Units::getUnitID("metal_storage"));
            $this->assertSame(10, D_Units::getUnitID("crystal_storage"));
            $this->assertSame(11, D_Units::getUnitID("deuterium_storage"));
            $this->assertSame(12, D_Units::getUnitID("research_lab"));
            $this->assertSame(13, D_Units::getUnitID("terraformer"));
            $this->assertSame(14, D_Units::getUnitID("alliance_depot"));
            $this->assertSame(15, D_Units::getUnitID("missile_silo"));
            $this->assertSame(101, D_Units::getUnitID("espionage_tech"));
            $this->assertSame(102, D_Units::getUnitID("computer_tech"));
            $this->assertSame(103, D_Units::getUnitID("weapon_tech"));
            $this->assertSame(104, D_Units::getUnitID("armour_tech"));
            $this->assertSame(105, D_Units::getUnitID("shielding_tech"));
            $this->assertSame(106, D_Units::getUnitID("energy_tech"));
            $this->assertSame(107, D_Units::getUnitID("hyperspace_tech"));
            $this->assertSame(108, D_Units::getUnitID("combustion_drive_tech"));
            $this->assertSame(109, D_Units::getUnitID("impulse_drive_tech"));
            $this->assertSame(110, D_Units::getUnitID("hyperspace_drive_tech"));
            $this->assertSame(111, D_Units::getUnitID("laser_tech"));
            $this->assertSame(112, D_Units::getUnitID("ion_tech"));
            $this->assertSame(113, D_Units::getUnitID("plasma_tech"));
            $this->assertSame(114, D_Units::getUnitID("intergalactic_research_tech"));
            $this->assertSame(115, D_Units::getUnitID("graviton_tech"));
            $this->assertSame(201, D_Units::getUnitID("small_cargo_ship"));
            $this->assertSame(202, D_Units::getUnitID("large_cargo_ship"));
            $this->assertSame(203, D_Units::getUnitID("light_fighter"));
            $this->assertSame(204, D_Units::getUnitID("heavy_fighter"));
            $this->assertSame(205, D_Units::getUnitID("cruiser"));
            $this->assertSame(206, D_Units::getUnitID("battleship"));
            $this->assertSame(207, D_Units::getUnitID("colony_ship"));
            $this->assertSame(208, D_Units::getUnitID("recycler"));
            $this->assertSame(209, D_Units::getUnitID("espionage_probe"));
            $this->assertSame(210, D_Units::getUnitID("bomber"));
            $this->assertSame(211, D_Units::getUnitID("solar_satellite"));
            $this->assertSame(212, D_Units::getUnitID("destroyer"));
            $this->assertSame(213, D_Units::getUnitID("battlecruiser"));
            $this->assertSame(214, D_Units::getUnitID("deathstar"));
            $this->assertSame(301, D_Units::getUnitID("rocket_launcher"));
            $this->assertSame(302, D_Units::getUnitID("light_laser"));
            $this->assertSame(303, D_Units::getUnitID("heavy_laser"));
            $this->assertSame(304, D_Units::getUnitID("gauss_cannon"));
            $this->assertSame(305, D_Units::getUnitID("ion_cannon"));
            $this->assertSame(306, D_Units::getUnitID("plasma_turret"));
            $this->assertSame(307, D_Units::getUnitID("small_shield_dome"));
            $this->assertSame(308, D_Units::getUnitID("large_shield_dome"));
            $this->assertSame(309, D_Units::getUnitID("anti_ballistic_missile"));
            $this->assertSame(310, D_Units::getUnitID("interplanetary_missile"));
        }

        /**
         * @covers D_Units::getUnitName
         */
        public function testGetUnitName() : void {
            $this->assertSame("metal_mine", D_Units::getUnitName(1));
            $this->assertSame("crystal_mine", D_Units::getUnitName(2));
            $this->assertSame("deuterium_synthesizer", D_Units::getUnitName(3));
            $this->assertSame("solar_plant", D_Units::getUnitName(4));
            $this->assertSame("fusion_reactor", D_Units::getUnitName(5));
            $this->assertSame("robotic_factory", D_Units::getUnitName(6));
            $this->assertSame("nanite_factory", D_Units::getUnitName(7));
            $this->assertSame("shipyard", D_Units::getUnitName(8));
            $this->assertSame("metal_storage", D_Units::getUnitName(9));
            $this->assertSame("crystal_storage", D_Units::getUnitName(10));
            $this->assertSame("deuterium_storage", D_Units::getUnitName(11));
            $this->assertSame("research_lab", D_Units::getUnitName(12));
            $this->assertSame("terraformer", D_Units::getUnitName(13));
            $this->assertSame("alliance_depot", D_Units::getUnitName(14));
            $this->assertSame("missile_silo", D_Units::getUnitName(15));
            $this->assertSame("espionage_tech", D_Units::getUnitName(101));
            $this->assertSame("computer_tech", D_Units::getUnitName(102));
            $this->assertSame("weapon_tech", D_Units::getUnitName(103));
            $this->assertSame("armour_tech", D_Units::getUnitName(104));
            $this->assertSame("shielding_tech", D_Units::getUnitName(105));
            $this->assertSame("energy_tech", D_Units::getUnitName(106));
            $this->assertSame("hyperspace_tech", D_Units::getUnitName(107));
            $this->assertSame("combustion_drive_tech", D_Units::getUnitName(108));
            $this->assertSame("impulse_drive_tech", D_Units::getUnitName(109));
            $this->assertSame("hyperspace_drive_tech", D_Units::getUnitName(110));
            $this->assertSame("laser_tech", D_Units::getUnitName(111));
            $this->assertSame("ion_tech", D_Units::getUnitName(112));
            $this->assertSame("plasma_tech", D_Units::getUnitName(113));
            $this->assertSame("intergalactic_research_tech", D_Units::getUnitName(114));
            $this->assertSame("graviton_tech", D_Units::getUnitName(115));
            $this->assertSame("small_cargo_ship", D_Units::getUnitName(201));
            $this->assertSame("large_cargo_ship", D_Units::getUnitName(202));
            $this->assertSame("light_fighter", D_Units::getUnitName(203));
            $this->assertSame("heavy_fighter", D_Units::getUnitName(204));
            $this->assertSame("cruiser", D_Units::getUnitName(205));
            $this->assertSame("battleship", D_Units::getUnitName(206));
            $this->assertSame("colony_ship", D_Units::getUnitName(207));
            $this->assertSame("recycler", D_Units::getUnitName(208));
            $this->assertSame("espionage_probe", D_Units::getUnitName(209));
            $this->assertSame("bomber", D_Units::getUnitName(210));
            $this->assertSame("solar_satellite", D_Units::getUnitName(211));
            $this->assertSame("destroyer", D_Units::getUnitName(212));
            $this->assertSame("battlecruiser", D_Units::getUnitName(213));
            $this->assertSame("deathstar", D_Units::getUnitName(214));
            $this->assertSame("rocket_launcher", D_Units::getUnitName(301));
            $this->assertSame("light_laser", D_Units::getUnitName(302));
            $this->assertSame("heavy_laser", D_Units::getUnitName(303));
            $this->assertSame("gauss_cannon", D_Units::getUnitName(304));
            $this->assertSame("ion_cannon", D_Units::getUnitName(305));
            $this->assertSame("plasma_turret", D_Units::getUnitName(306));
            $this->assertSame("small_shield_dome", D_Units::getUnitName(307));
            $this->assertSame("large_shield_dome", D_Units::getUnitName(308));
            $this->assertSame("anti_ballistic_missile", D_Units::getUnitName(309));
            $this->assertSame("interplanetary_missile", D_Units::getUnitName(310));
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
                         15 => 'missile_silo'
            ];

            $this->assertSame($expected, D_Units::getBuildings());
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
                         115 => 'graviton_tech'
            ];

            $this->assertSame($expected, D_Units::getTechnologies());
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
                         214 => 'deathstar'
            ];

            $this->assertSame($expected, D_Units::getFleet());
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
                         310 => 'interplanetary_missile'
            ];

            $this->assertSame($expected, D_Units::getDefense());
        }

        /**
         * @covers D_Units::getName
         */
        public function testGetName() : void {
            $this->assertSame("Metal Mine", D_Units::getName(1));

            $this->assertSame("", D_Units::getName(-1));
        }

        /**
         * @covers D_Units::getDescription
         */
        public function testGetDescription() : void {
            $this->assertSame("Metal is the main resource for conducting research and the construction of buildings, ships, and defensive units.",
                D_Units::getDescription(1));


            $this->assertSame("",
                D_Units::getDescription(-1));
        }

        /**
         * @covers D_Units::getPriceList
         */
        public function testGetPricelist() : void {
            $this->assertSame(['metal' => 60, 'crystal' => 15, 'deuterium' => 0, 'energy' => 0, 'factor' => 1.5],
                D_Units::getPriceList(1));

            $this->assertSame([], D_Units::getPriceList(-1));
        }

        /**
         * @covers D_Units::getRequirements
         */
        public function testGetRequirements() : void {
            $this->assertSame([12 => 7, 106 => 5, 105 => 5], D_Units::getRequirements(107));
            $this->assertSame([], D_Units::getRequirements(99999999));
        }

        /**
         * @covers D_Units::getBuildTime
         */
        public function testGetBuildTimeBuilding() : void {

            $building = new U_Building(1, 0, 60, 15, 0, 0, 1.5);


            $this->assertSame(108.0, D_Units::getBuildTime($building, 0, 0, 0) * 3600);
        }

        /**
         * @covers D_Units::getBuildTime
         */
        public function testGetBuildTimeTech() : void {

            $research = new U_Tech(101, 0, 200, 100, 200, 0, 2);


            $this->assertSame(864.0, D_Units::getBuildTime($research, 0, 0, 0) * 3600);
        }

        /**
         * @covers D_Units::getBuildTime
         */
        public function testGetBuildTimeFleetOrDefense() : void {

            $fleet = new U_Fleet(201, 0, 2000, 2000, 0, 0, 1);

            $this->assertSame(5760.0, D_Units::getBuildTime($fleet, 0, 0, 0) * 3600);

            $this->assertSame(-1.0, D_Units::getBuildTime($fleet, -1, 0, 0));

            $fleet = new U_Fleet(999, 0, 2000, 2000, 0, 0, 1);

            $this->assertSame(-1.0, D_Units::getBuildTime($fleet, 0, 0, 0));

        }

        /**
         * @covers D_Units::getStorageCapacity
         */
        public function testGetStorageCapacity() : void {

            $level = 5;

            $this->assertSame(100000 + 50000 * (ceil(pow(1.5, $level)) - 1), D_Units::getStorageCapacity($level));

            $this->assertSame(-1.0, D_Units::getStorageCapacity(-1));

        }

        /**
         * @covers D_Units::getMetalProductionPerHour
         */
        public function testGetMetalProductionPerHour() : void {

            $level = 12;
            $plasmaLevel = 3;

            $this->assertSame(floor(30 * $level * pow(1.1, $level)) * ((100 + 1 * $plasmaLevel)/100), D_Units::getMetalProductionPerHour($level, $plasmaLevel));

            $this->assertSame(-1.0, D_Units::getMetalProductionPerHour(-1, $plasmaLevel));
        }

        /**
         * @covers D_Units::getCrystalProductionPerHour
         */
        public function testGetCrystalProductionPerHour() : void {

            $level = 5;
            $plasmaLevel = 12;

            $this->assertSame(floor(20 * $level * pow(1.1, $level)) * ((100 + 0.66 * $plasmaLevel)/100), D_Units::getCrystalProductionPerHour($level, $plasmaLevel));

            $this->assertSame(-1.0, D_Units::getCrystalProductionPerHour(-1, $plasmaLevel));
        }

        /**
         * @covers D_Units::getDeuteriumProductionPerHour
         */
        public function testGetDeuteriumProductionPerHour() : void {

            $level = 8;
            $maxTemp = 130;

            $this->assertSame(floor(10 * $level * pow(1.1, $level) * (1.28 - 0.002 * $maxTemp)), D_Units::getDeuteriumProductionPerHour($level, $maxTemp));

            $this->assertSame(-1.0, D_Units::getDeuteriumProductionPerHour(-1, $maxTemp));

        }

        /**
         * @covers D_Units::getEnergyProduction
         */
        public function testGetEnergyProduction() : void {

            $this->assertSame(['solar_plant'     => 22.0,
                               'fusion_reactor'  => 61.79999999999999,
                               'solar_satellite' => 20.25
            ], D_Units::getEnergyProduction(1, 1, 1, 1, 1));


            $this->assertSame([], D_Units::getEnergyProduction(-1, 1, 1, 1, 1));


        }

        /**
         * @covers D_Units::getEnergyConsumption
         */
        public function testGetEnergyConsumption() : void {

            $level = 13;

            $this->assertSame(10 * $level * pow(1.1, $level), D_Units::getEnergyConsumption($level));
            $this->assertSame(-1.0, D_Units::getEnergyConsumption(-1));

        }

    }
