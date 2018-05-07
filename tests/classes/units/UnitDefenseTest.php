<?php

    declare(strict_types=1);

    if (!defined('INSIDE')) {
        define('INSIDE', true);
    }

    require_once dirname(dirname(dirname(__FILE__))) . '/config.php';

    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/data/units.php";
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/units/unit.php";
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/units/defense.php";

    use PHPUnit\Framework\TestCase;

    /**
     * Class UnitDefenseTest
     * @covers U_Unit::__construct
     * @covers U_Defense::__construct
     * @codeCoverageIgnore
     */
    final class UnitDefenseTest extends TestCase {

        /**
         * @covers U_Unit::getCostMetal
         * @covers U_Defense::getCostMetal
         */
        public function testGetCostMetal() : void {

//            $data = new D_Units();
//
//            for($i = 301; $i <= 310; $i ++) {
//                $unitID = $i;
//                $amount = rand(1,100000);
//
//                $priceList = $data->getPriceList($unitID);
//
//                $building = new U_Defense($unitID, $amount, $priceList['metal'], $priceList['crystal'],
//                    $priceList['deuterium'], $priceList['energy'], $priceList['factor']);
//
//                $this->assertSame(floor($priceList['metal'] * pow($priceList['factor'], $amount)),
//                    $building->getCostMetal());
//            }

            $amount = 100;

            $building = new U_Defense(301, $amount, 60, 15, 0, 0, 1.5);

            $this->assertSame(0.0, $building->getCostMetal());

        }

        /**
         * @covers U_Unit::getCostCrystal
         * @covers U_Defense::getCostCrystal
         */
        public function testGetCostCrystal() : void {
            $level = 1;

            $building = new U_Defense(302, $level, 60, 15, 0, 0, 1.5);

            $this->assertSame(0.0, $building->getCostCrystal());
        }

        /**
         * @covers U_Unit::getCostDeuterium
         * @covers U_Defense::getCostDeuterium
         */
        public function testGetCostDeuterium() : void {
            $building = new U_Defense(303, 1, 60, 40, 0, 0, 1.5);
            $this->assertSame(0.0, $building->getCostDeuterium());
        }

        /**
         * @covers U_Unit::getCostEnergy
         * @covers U_Defense::getCostEnergy
         */
        public function testGetCostEnergy() : void {
            $building = new U_Defense(301, 1, 60, 40, 0, 0, 1.5);
            $this->assertSame(0.0, $building->getCostEnergy());
        }

        /**
         * @covers U_Defense::getAmount
         */
        public function testGetAmount() : void {
            $building = new U_Defense(305, 105, 60, 40, 0, 0, 1.5);
            $this->assertSame(105, $building->getAmount());
        }

    }
