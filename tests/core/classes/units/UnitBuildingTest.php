<?php

    declare(strict_types = 1);

    use PHPUnit\Framework\TestCase;

    /**
     * Class UnitBuildingTest
     * @covers U_Unit::__construct
     * @covers U_Building::__construct
     * @codeCoverageIgnore
     */
    final class UnitBuildingTest extends TestCase {

        /**
         * @covers U_Unit::getCostMetal
         * @covers U_Building::getCostMetal
         */
        public function testGetCostMetal() : void {
            $data = new D_Units();

            for ($i = 1; $i <= 15; $i++) {
                $unitID = $i;
                $level = rand(1, 30);
                $priceList = $data->getPriceList($unitID);
                $building = new U_Building($unitID, $level, $priceList['metal'], $priceList['crystal'],
                    $priceList['deuterium'], $priceList['energy'], $priceList['factor']);

                $this->assertSame(floor($priceList['metal'] * pow($priceList['factor'], $level)),
                    $building->getCostMetal());
            }

        }

        /**
         * @covers U_Unit::getCostCrystal
         * @covers U_Building::getCostCrystal
         */
        public function testGetCostCrystal() : void {
            $data = new D_Units();

            for ($i = 1; $i <= 15; $i++) {
                $unitID = $i;
                $level = rand(1, 30);
                $priceList = $data->getPriceList($unitID);
                $building = new U_Building($unitID, $level, $priceList['metal'], $priceList['crystal'],
                    $priceList['deuterium'], $priceList['energy'], $priceList['factor']);

                $this->assertSame(floor($priceList['crystal'] * pow($priceList['factor'], $level)),
                    $building->getCostCrystal());
            }
        }

        /**
         * @covers U_Unit::getCostDeuterium
         * @covers U_Building::getCostDeuterium
         */
        public function testGetCostDeuterium() : void {
            $data = new D_Units();

            for ($i = 1; $i <= 15; $i++) {
                $unitID = $i;
                $level = rand(1, 30);
                $priceList = $data->getPriceList($unitID);
                $building = new U_Building($unitID, $level, $priceList['metal'], $priceList['crystal'],
                    $priceList['deuterium'], $priceList['energy'], $priceList['factor']);

                $this->assertSame(floor($priceList['deuterium'] * pow($priceList['factor'], $level)),
                    $building->getCostDeuterium());
            }


        }

        /**
         * @covers U_Unit::getCostEnergy
         * @covers U_Building::getCostEnergy
         */
        public function testGetCostEnergy() : void {
            $data = new D_Units();

            for ($i = 1; $i <= 15; $i++) {
                $unitID = $i;
                $level = rand(1, 30);
                $priceList = $data->getPriceList($unitID);
                $building = new U_Building($unitID, $level, $priceList['metal'], $priceList['crystal'],
                    $priceList['deuterium'], $priceList['energy'], $priceList['factor']);

                $this->assertSame(floor($priceList['energy'] * pow($priceList['factor'], $level)),
                    $building->getCostEnergy());
            }
        }

        /**
         * @covers U_Building::getEnergyConsumption
         */
        public function testGetEnergyConsumption() : void {

            $data = new D_Units();

            $unitID = 1;
            $priceList = $data->getPriceList($unitID);
            $building = new U_Building($unitID, 8, $priceList['metal'], $priceList['crystal'], $priceList['deuterium'],
                $priceList['energy'], $priceList['factor']);
            $this->assertSame(172.0, $building->getEnergyConsumption(100, 100, 100));

            $unitID = 2;
            $priceList = $data->getPriceList($unitID);
            $building = new U_Building($unitID, 11, $priceList['metal'], $priceList['crystal'], $priceList['deuterium'],
                $priceList['energy'], $priceList['factor']);
            $this->assertSame(314.0, $building->getEnergyConsumption(100, 100, 100));

            $unitID = 3;
            $priceList = $data->getPriceList($unitID);
            $building = new U_Building($unitID, 15, $priceList['metal'], $priceList['crystal'], $priceList['deuterium'],
                $priceList['energy'], $priceList['factor']);
            $this->assertSame(1254.0, $building->getEnergyConsumption(100, 100, 100));

            $unitID = 15;
            $building = new U_Building($unitID, 15, $priceList['metal'], $priceList['crystal'], $priceList['deuterium'],
                $priceList['energy'], $priceList['factor']);
            $this->assertSame(0.0, $building->getEnergyConsumption(100, 100, 100));

        }

        /**
         * @covers U_Building::getLevel
         */
        public function testGetLevel() : void {
            $building = new U_Building(1, 36, 60, 40, 0, 0, 1.5);
            $this->assertSame(36, $building->getLevel());
        }

    }
