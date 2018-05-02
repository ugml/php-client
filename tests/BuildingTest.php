<?php

    declare(strict_types=1);


    require_once __DIR__.'/config.php';

    require_once "core/classes/units/unit.php";
    require_once "core/classes/units/building.php";

    use PHPUnit\Framework\TestCase;

    final class BuildingTest extends TestCase {

        public function testGetCostMetal() : void {

            $level = 1;

            $building = new U_Building(1, $level, 60, 15, 0, 0, 1.5);

            $this->assertSame(floor(60 * pow(1.5, 1)), $building->getCostMetal());

        }

        public function testGetCostCrystal() : void {
            $level = 1;

            $building = new U_Building(1, $level, 60, 15, 0, 0, 1.5);

            $this->assertSame(floor(15 * pow(1.5, $level)), $building->getCostCrystal());
        }

        public function testGetCostDeuterium() : void {
            $building = new U_Building(1, 1, 60, 40, 0, 0, 1.5);
            $this->assertSame(floor(0), $building->getCostDeuterium());
        }

        public function testGetCostEnergy() : void {
            $building = new U_Building(1, 1, 60, 40, 0, 0, 1.5);
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
