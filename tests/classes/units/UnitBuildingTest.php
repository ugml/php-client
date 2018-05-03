<?php

    declare(strict_types=1);

    if (!defined('INSIDE')) {
        define('INSIDE', true);
    }

//    require_once dirname(dirname(dirname(__FILE__))) . '/config.php';

    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/units/unit.php";
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/units/building.php";

    use PHPUnit\Framework\TestCase;

    /**
     * Class UnitBuildingTest
     * @codeCoverageIgnore
     */
    final class UnitBuildingTest extends TestCase {

        /**
         * @covers U_Building::getCostMetal
         */
        public function testGetCostMetal() : void {

            $level = 1;

            $building = new U_Building(1, $level, 60, 15, 0, 0, 1.5);

            $this->assertSame(floor(60 * pow(1.5, 1)), $building->getCostMetal());

        }

        /**
         * @covers U_Building::getCostCrystal
         */
        public function testGetCostCrystal() : void {
            $level = 1;

            $building = new U_Building(1, $level, 60, 15, 0, 0, 1.5);

            $this->assertSame(floor(15 * pow(1.5, $level)), $building->getCostCrystal());
        }

        /**
         * @covers U_Building::getCostDeuterium
         */
        public function testGetCostDeuterium() : void {
            $building = new U_Building(1, 1, 60, 40, 0, 0, 1.5);
            $this->assertSame(floor(0), $building->getCostDeuterium());
        }

        /**
         * @covers U_Building::getCostEnergy
         */
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
