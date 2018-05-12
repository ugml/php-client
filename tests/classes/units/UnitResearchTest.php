<?php

    declare(strict_types=1);

    if (!defined('INSIDE')) {
        define('INSIDE', true);
    }

//    require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/core/config.sample.php';

//    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/data/units.php";
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/units/unit.php";
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/units/research.php";

    use PHPUnit\Framework\TestCase;

    /**
     * Class UnitResearchTest
     * @covers U_Unit::__construct
     * @covers U_Research::__construct
     * @codeCoverageIgnore
     */
    final class UnitResearchTest extends TestCase {

        /**
         * @covers U_Unit::getCostMetal
         * @covers U_Research::getCostMetal
         */
        public function testGetCostMetal() : void {

            $level = 1;

            $research = new U_Research(101, $level, 60, 15, 0, 0, 1.5);

            $this->assertSame(90.0, $research->getCostMetal());

        }

        /**
         * @covers U_Unit::getCostCrystal()
         * @covers U_Research::getCostCrystal
         */
        public function testGetCostCrystal() : void {
            $level = 1;

            $research = new U_Research(102, $level, 60, 15, 0, 0, 1.5);

            $this->assertSame(22.0, $research->getCostCrystal());
        }

        /**
         * @covers U_Unit::getCostDeuterium
         * @covers U_Research::getCostDeuterium
         */
        public function testGetCostDeuterium() : void {
            $research = new U_Research(103, 1, 60, 40, 0, 0, 1.5);
            $this->assertSame(0.0, $research->getCostDeuterium());
        }

        /**
         * @covers U_Unit::getCostEnergy
         * @covers U_Research::getCostEnergy
         */
        public function testGetCostEnergy() : void {
            $research = new U_Research(104, 1, 60, 40, 0, 0, 1.5);
            $this->assertSame(0.0, $research->getCostEnergy());
        }

        /**
         * @covers U_Research::getLevel
         */
        public function testGetSetAmount() : void {
            $research = new U_Research(105, 10, 60, 40, 0, 0, 1.5);
            $this->assertSame(10, $research->getLevel());
        }

    }
