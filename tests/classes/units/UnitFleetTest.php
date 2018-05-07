<?php

    declare(strict_types=1);

    if (!defined('INSIDE')) {
        define('INSIDE', true);
    }

//    require_once dirname(dirname(dirname(__FILE__))) . '/config.php';

//    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/data/units.php";
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/units/unit.php";
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/units/fleet.php";

    use PHPUnit\Framework\TestCase;

    /**
     * Class UnitFleetTest
     * @covers U_Unit::__construct
     * @covers U_Fleet::__construct
     * @codeCoverageIgnore
     */
    final class UnitFleetTest extends TestCase {

        /**
         * @covers U_Unit::getCostMetal
         * @covers U_Fleet::getCostMetal
         */
        public function testGetCostMetal() : void {

            $amount = 100;

            $fleet = new U_Fleet(1, $amount, 60, 15, 0, 0, 1.5);

            $this->assertSame(60.0, $fleet->getCostMetal());

        }

        /**
         * @covers U_Unit::getCostCrystal
         * @covers U_Fleet::getCostCrystal
         */
        public function testGetCostCrystal() : void {
            $level = 1;

            $fleet = new U_Fleet(1, $level, 60, 15, 0, 0, 1.5);

            $this->assertSame(15.0, $fleet->getCostCrystal());
        }

        /**
         * @covers U_Unit::getCostDeuterium
         * @covers U_Fleet::getCostDeuterium
         */
        public function testGetCostDeuterium() : void {
            $fleet = new U_Fleet(1, 1, 60, 40, 0, 0, 1.5);
            $this->assertSame(0.0, $fleet->getCostDeuterium());
        }

        /**
         * @covers U_Unit::getCostEnergy
         * @covers U_Fleet::getCostEnergy
         */
        public function testGetCostEnergy() : void {
            $fleet = new U_Fleet(1, 1, 60, 40, 0, 0, 1.5);
            $this->assertSame(0.0, $fleet->getCostEnergy());
        }

        /**
         * @covers U_Fleet::setAmount
         * @covers U_Fleet::getAmount
         */
        public function testGetSetAmount() : void {
            $fleet = new U_Fleet(1, 105, 60, 40, 0, 0, 1.5);
            $this->assertSame(105, $fleet->getAmount());

            $this->assertSame(null, $fleet->setAmount(99));

            $this->assertSame(99, $fleet->getAmount());
        }

    }
