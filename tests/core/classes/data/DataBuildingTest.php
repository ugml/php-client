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

        protected function setUp() : void {
            $this->buildingData = new D_Building(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
        }

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

        /**
         * @covers D_Building::getBuildingByID
         */
        public function testGetDefenseByID() : void {

            $this->assertSame(-1, $this->buildingData->getBuildingByID(0));
            $this->assertSame(1, $this->buildingData->getBuildingByID(1));
            $this->assertSame(2, $this->buildingData->getBuildingByID(2));
            $this->assertSame(3, $this->buildingData->getBuildingByID(3));
            $this->assertSame(4, $this->buildingData->getBuildingByID(4));
            $this->assertSame(5, $this->buildingData->getBuildingByID(5));
            $this->assertSame(6, $this->buildingData->getBuildingByID(6));
            $this->assertSame(7, $this->buildingData->getBuildingByID(7));
            $this->assertSame(8, $this->buildingData->getBuildingByID(8));
            $this->assertSame(9, $this->buildingData->getBuildingByID(9));
            $this->assertSame(10, $this->buildingData->getBuildingByID(10));
            $this->assertSame(11, $this->buildingData->getBuildingByID(11));
            $this->assertSame(12, $this->buildingData->getBuildingByID(12));
            $this->assertSame(13, $this->buildingData->getBuildingByID(13));
            $this->assertSame(14, $this->buildingData->getBuildingByID(14));
            $this->assertSame(15, $this->buildingData->getBuildingByID(15));
            $this->assertSame(-1, $this->buildingData->getBuildingByID(16));
        }

        /**
         * @covers D_Building::getBuildingByID()
         * @covers D_Building::setBuildingByID()
         */
        public function testSetBuildingByID() : void {

            $this->buildingData->setBuildingByID(1,10);
            $this->assertSame(10, $this->buildingData->getMetalMine());

            $this->buildingData->setBuildingByID(2,11);
            $this->assertSame(11, $this->buildingData->getCrystalMine());

            $this->buildingData->setBuildingByID(3,12);
            $this->assertSame(12, $this->buildingData->getDeuteriumSynthesizer());

            $this->buildingData->setBuildingByID(4,13);
            $this->assertSame(13, $this->buildingData->getSolarPlant());

            $this->buildingData->setBuildingByID(5,14);
            $this->assertSame(14, $this->buildingData->getFusionReactor());

            $this->buildingData->setBuildingByID(6,15);
            $this->assertSame(15, $this->buildingData->getRoboticFactory());

            $this->buildingData->setBuildingByID(7,16);
            $this->assertSame(16, $this->buildingData->getNaniteFactory());

            $this->buildingData->setBuildingByID(8,17);
            $this->assertSame(17, $this->buildingData->getShipyard());

            $this->buildingData->setBuildingByID(9,18);
            $this->assertSame(18, $this->buildingData->getMetalStorage());

            $this->buildingData->setBuildingByID(10,19);
            $this->assertSame(19, $this->buildingData->getCrystalStorage());

            $this->buildingData->setBuildingByID(11,20);
            $this->assertSame(20, $this->buildingData->getDeuteriumStorage());

            $this->buildingData->setBuildingByID(12,21);
            $this->assertSame(21, $this->buildingData->getResearchLab());

            $this->buildingData->setBuildingByID(13,22);
            $this->assertSame(22, $this->buildingData->getTerraformer());

            $this->buildingData->setBuildingByID(14,23);
            $this->assertSame(23, $this->buildingData->getAllianceDepot());

            $this->buildingData->setBuildingByID(15,24);
            $this->assertSame(24, $this->buildingData->getMissileSilo());
        }

    }
