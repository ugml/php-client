<?php

    declare(strict_types = 1);

    use PHPUnit\Framework\TestCase;

    /**
     * Class UnitResearchTest
     * @covers U_Unit::__construct
     * @covers U_Tech::__construct
     * @codeCoverageIgnore
     */
    final class UnitResearchTest extends TestCase {

        /**
         * @covers U_Unit::getCostMetal
         * @covers U_Tech::getCostMetal
         */
        public function testGetCostMetal() : void {

            $level = 1;

            $tech = new U_Tech(101, $level, 60, 15, 0, 0, 1.5);

            $this->assertSame(90.0, $tech->getCostMetal());

        }

        /**
         * @covers U_Unit::getCostCrystal()
         * @covers U_Tech::getCostCrystal
         */
        public function testGetCostCrystal() : void {
            $level = 1;

            $tech = new U_Tech(102, $level, 60, 15, 0, 0, 1.5);

            $this->assertSame(22.0, $tech->getCostCrystal());
        }

        /**
         * @covers U_Unit::getCostDeuterium
         * @covers U_Tech::getCostDeuterium
         */
        public function testGetCostDeuterium() : void {
            $tech = new U_Tech(103, 1, 60, 40, 0, 0, 1.5);
            $this->assertSame(0.0, $tech->getCostDeuterium());
        }

        /**
         * @covers U_Unit::getCostEnergy
         * @covers U_Tech::getCostEnergy
         */
        public function testGetCostEnergy() : void {
            $tech = new U_Tech(104, 1, 60, 40, 0, 0, 1.5);
            $this->assertSame(0.0, $tech->getCostEnergy());
        }

        /**
         * @covers U_Tech::getLevel
         */
        public function testGetSetAmount() : void {
            $tech = new U_Tech(105, 10, 60, 40, 0, 0, 1.5);
            $this->assertSame(10, $tech->getLevel());
        }

    }
