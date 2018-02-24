<?php

    use PHPUnit\Framework\TestCase;

//    define("INSIDE", true);

    require_once __DIR__.'/../core/autoload.php';

    class BuildingTest extends TestCase {

        public function testGetCostMetal() {
            $level = 1;

            $building = new Unit_Building(1, $level, 60, 15, 0, 0, 1.5);

            $this->assertSame(floor(60 * pow(1.5, 1)), $building->getCostMetal());

        }

        public function testGetCostCrystal() {
            $level = 1;

            $building = new Unit_Building(1, $level, 60, 15, 0, 0, 1.5);

            $this->assertSame(floor(15 * pow(1.5, $level)), $building->getCostCrystal());
        }

        public function testGetCostDeuterium() {
            $building = new Unit_Building(1, 1, 60, 40, 0, 0, 1.5);
            $this->assertSame(floor(0), $building->getCostDeuterium());
        }

        public function testGetCostEnergy() {
            $building = new Unit_Building(1, 1, 60, 40, 0, 0, 1.5);
            $this->assertSame(floor(0), $building->getCostEnergy());
        }

        //        public function testGetEnergyConsumption() {
        //            $level = 8;
        //
        //            $building = new Building(1,1,60,40,0,0,1.5);
        //
        //            $this->assertSame(ceil(10 * $level * pow(1.1, $level)), $building->getEnergyConsumption());
        //
        //        }
    }
