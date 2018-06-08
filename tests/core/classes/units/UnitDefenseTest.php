<?php

    declare(strict_types = 1);

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
