<?php

    declare(strict_types = 1);

    use PHPUnit\Framework\TestCase;

    /**
     * Class DataBuildingTest
     * @covers D_Building::__construct
     * @codeCoverageIgnore
     */
    final class DataBuildingTest extends TestCase {

        private $buildingData;

        /**
         * @covers D_Building::setMetalMine
         * @covers D_Building::getMetalMine
         */
        public function testGetSetMetalMine() : void {
            $this->buildingData->setMetalMine(5);
            $this->assertSame(5, $this->buildingData->getMetalMine());
        }

        /**
         * @covers D_Building::setCrystalMine
         * @covers D_Building::getCrystalMine
         */
        public function testGetSetCrystalMine() : void {
            $this->buildingData->setCrystalMine(5);
            $this->assertSame(5, $this->buildingData->getCrystalMine());
        }

        /**
         * @covers D_Building::setDeuteriumSynthesizer
         * @covers D_Building::getDeuteriumSynthesizer
         */
        public function testGetSetDeuteriumSynthesizer() : void {
            $this->buildingData->setDeuteriumSynthesizer(5);
            $this->assertSame(5, $this->buildingData->getDeuteriumSynthesizer());
        }

        /**
         * @covers D_Building::setSolarPlant
         * @covers D_Building::getSolarPlant
         */
        public function testGetSetSolarPlant() : void {
            $this->buildingData->setSolarPlant(5);
            $this->assertSame(5, $this->buildingData->getSolarPlant());
        }

        /**
         * @covers D_Building::setFusionReactor
         * @covers D_Building::getFusionReactor
         */
        public function testGetSetFusionReactor() : void {
            $this->buildingData->setFusionReactor(5);
            $this->assertSame(5, $this->buildingData->getFusionReactor());
        }

        /**
         * @covers D_Building::setRoboticFactory
         * @covers D_Building::getRoboticFactory
         */
        public function testGetSetRoboticFactory() : void {
            $this->buildingData->setRoboticFactory(5);
            $this->assertSame(5, $this->buildingData->getRoboticFactory());
        }

        /**
         * @covers D_Building::setNaniteFactory
         * @covers D_Building::getNaniteFactory
         */
        public function testGetSetNaniteFactory() : void {
            $this->buildingData->setNaniteFactory(5);
            $this->assertSame(5, $this->buildingData->getNaniteFactory());
        }

        /**
         * @covers D_Building::setShipyard
         * @covers D_Building::getShipyard
         */
        public function testGetSetShipyard() : void {
            $this->buildingData->setShipyard(5);
            $this->assertSame(5, $this->buildingData->getShipyard());
        }

        /**
         * @covers D_Building::setMetalStorage
         * @covers D_Building::getMetalStorage
         */
        public function testGetSetMetalStorage() : void {
            $this->buildingData->setMetalStorage(5);
            $this->assertSame(5, $this->buildingData->getMetalStorage());
        }

        /**
         * @covers D_Building::setCrystalStorage
         * @covers D_Building::getCrystalStorage
         */
        public function testGetSetCrystalStorage() : void {
            $this->buildingData->setCrystalStorage(5);
            $this->assertSame(5, $this->buildingData->getCrystalStorage());
        }

        /**
         * @covers D_Building::setDeuteriumStorage
         * @covers D_Building::getDeuteriumStorage
         */
        public function testGetSetDeuteriumStorage() : void {
            $this->buildingData->setDeuteriumStorage(5);
            $this->assertSame(5, $this->buildingData->getDeuteriumStorage());
        }

        /**
         * @covers D_Building::setResearchLab
         * @covers D_Building::getResearchLab
         */
        public function testGetSetResearchLab() : void {
            $this->buildingData->setResearchLab(5);
            $this->assertSame(5, $this->buildingData->getResearchLab());
        }

        /**
         * @covers D_Building::setTerraformer
         * @covers D_Building::getTerraformer
         */
        public function testGetSetTerraformer() : void {
            $this->buildingData->setTerraformer(5);
            $this->assertSame(5, $this->buildingData->getTerraformer());
        }

        /**
         * @covers D_Building::setAllianceDepot
         * @covers D_Building::getAllianceDepot
         */
        public function testGetSetAllianceDepot() : void {
            $this->buildingData->setAllianceDepot(5);
            $this->assertSame(5, $this->buildingData->getAllianceDepot());
        }

        /**
         * @covers D_Building::setMissileSilo
         * @covers D_Building::getMissileSilo
         */
        public function testGetSetMissileSilo() : void {
            $this->buildingData->setMissileSilo(5);
            $this->assertSame(5, $this->buildingData->getMissileSilo());
        }

        protected function setUp() : void {
            $this->buildingData = new D_Building(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);
        }

    }
