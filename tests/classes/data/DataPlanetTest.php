<?php

    declare(strict_types = 1);

    use PHPUnit\Framework\TestCase;

    /**
     * Class DataPlanetTest
     * @covers D_Planet::__construct
     * @codeCoverageIgnore
     */
    final class DataPlanetTest extends TestCase {

        private $planetData;

        protected function setUp() : void {
            $this->planetData = new D_Planet(1, 15, "Testplanet", 4, 245, 13, time(), 1, "null", 15360, 0, 198, -12, 10,
                500000, 245000, 13000, 0, 123, 100, 100, 100, 100, 100, 100, 1, 1, 1, 1, 1, "201,50;", false, false);
        }

        /**
         * @covers D_Planet::setMetalMinePercent
         * @covers D_Planet::getMetalMinePercent
         */
        public function testGetSetMetalMinePercent() : void {
            $this->planetData->setMetalMinePercent(80);
            $this->assertSame(80, $this->planetData->getMetalMinePercent());
        }

        /**
         * @covers D_Planet::setCrystalMinePercent
         * @covers D_Planet::getCrystalMinePercent
         */
        public function testGetSetCrystalMinePercent() : void {
            $this->planetData->setCrystalMinePercent(30);
            $this->assertSame(30, $this->planetData->getCrystalMinePercent());
        }

        /**
         * @covers D_Planet::setDeuteriumSynthesizerPercent
         * @covers D_Planet::getDeuteriumSynthesizerPercent
         */
        public function testGetSetDeuteriumSynthesizerPercent() : void {
            $this->planetData->setDeuteriumSynthesizerPercent(10);
            $this->assertSame(10, $this->planetData->getDeuteriumSynthesizerPercent());
        }

        /**
         * @covers D_Planet::setFusionReactorPercent
         * @covers D_Planet::getFusionReactorPercent
         */
        public function testGetSetFusionReactorPercent() : void {
            $this->planetData->setFusionReactorPercent(40);
            $this->assertSame(40, $this->planetData->getFusionReactorPercent());
        }

        /**
         * @covers D_Planet::setPlanetID
         * @covers D_Planet::getPlanetID
         */
        public function testGetSetPlanetID() : void {
            $this->planetData->setPlanetID(40);
            $this->assertSame(40, $this->planetData->getPlanetID());
        }

        /**
         * @covers D_Planet::setOwnerID
         * @covers D_Planet::getOwnerID
         */
        public function testGetSetOwnerID() : void {
            $this->planetData->setOwnerID(40);
            $this->assertSame(40, $this->planetData->getOwnerID());
        }

        /**
         * @covers D_Planet::setName
         * @covers D_Planet::getName
         */
        public function testGetSetName() : void {
            $this->planetData->setName("Test");
            $this->assertSame("Test", $this->planetData->getName());
        }

        /**
         * @covers D_Planet::setGalaxy
         * @covers D_Planet::getGalaxy
         */
        public function testGetSetGalaxy() : void {
            $this->planetData->setGalaxy(3);
            $this->assertSame(3, $this->planetData->getGalaxy());
        }

        /**
         * @covers D_Planet::setSystem
         * @covers D_Planet::getSystem
         */
        public function testGetSetSystem() : void {
            $this->planetData->setSystem(12);
            $this->assertSame(12, $this->planetData->getSystem());
        }

        /**
         * @covers D_Planet::setPlanet
         * @covers D_Planet::getPlanet
         */
        public function testGetSetPlanet() : void {
            $this->planetData->setPlanet(12);
            $this->assertSame(12, $this->planetData->getPlanet());
        }

        /**
         * @covers D_Planet::setLastUpdate
         * @covers D_Planet::getLastUpdate
         */
        public function testGetSetLastUpdate() : void {
            $time = time();
            $this->planetData->setLastUpdate($time);
            $this->assertSame($time, $this->planetData->getLastUpdate());
        }

        /**
         * @covers D_Planet::setPlanetType
         * @covers D_Planet::getPlanetType
         */
        public function testGetSetPlanetType() : void {
            $this->planetData->setPlanetType(1);
            $this->assertSame(1, $this->planetData->getPlanetType());
        }

        /**
         * @covers D_Planet::setImage
         * @covers D_Planet::getImage
         */
        public function testGetSetImage() : void {
            $this->planetData->setImage("myImage.jpg");
            $this->assertSame("myImage.jpg", $this->planetData->getImage());
        }

        /**
         * @covers D_Planet::setDiameter
         * @covers D_Planet::getDiameter
         */
        public function testGetSetDiameter() : void {
            $this->planetData->setDiameter(12);
            $this->assertSame(12, $this->planetData->getDiameter());
        }

        /**
         * @covers D_Planet::setFieldsCurrent
         * @covers D_Planet::getFieldsCurrent
         */
        public function testGetSetFieldsCurrent() : void {
            $this->planetData->setFieldsCurrent(12);
            $this->assertSame(12, $this->planetData->getFieldsCurrent());
        }

        /**
         * @covers D_Planet::setFieldsMax
         * @covers D_Planet::getFieldsMax
         */
        public function testGetSetFieldsMax() : void {
            $this->planetData->setFieldsMax(12);
            $this->assertSame(12, $this->planetData->getFieldsMax());
        }

        /**
         * @covers D_Planet::setTempMin
         * @covers D_Planet::getTempMin
         */
        public function testGetSetTempMin() : void {
            $this->planetData->setTempMin(12);
            $this->assertSame(12, $this->planetData->getTempMin());
        }

        /**
         * @covers D_Planet::setTempMax
         * @covers D_Planet::getTempMax
         */
        public function testGetSetTempMax() : void {
            $this->planetData->setTempMax(12);
            $this->assertSame(12, $this->planetData->getTempMax());
        }

        /**
         * @covers D_Planet::setMetal
         * @covers D_Planet::getMetal
         */
        public function testGetSetMetal() : void {
            $this->planetData->setMetal(12);
            $this->assertSame(12.0, $this->planetData->getMetal());
        }

        /**
         * @covers D_Planet::setCrystal
         * @covers D_Planet::getCrystal
         */
        public function testGetSetCrystal() : void {
            $this->planetData->setCrystal(12);
            $this->assertSame(12.0, $this->planetData->getCrystal());
        }

        /**
         * @covers D_Planet::setDeuterium
         * @covers D_Planet::getDeuterium
         */
        public function testGetSetDeuterium() : void {
            $this->planetData->setDeuterium(12);
            $this->assertSame(12.0, $this->planetData->getDeuterium());
        }

        /**
         * @covers D_Planet::setEnergyUsed
         * @covers D_Planet::getEnergyUsed
         */
        public function testGetSetEnergyUsed() : void {
            $this->planetData->setEnergyUsed(12);
            $this->assertSame(12, $this->planetData->getEnergyUsed());
        }

        /**
         * @covers D_Planet::setEnergyMax
         * @covers D_Planet::getEnergyMax
         */
        public function testGetSetEnergyMax() : void {
            $this->planetData->setEnergyMax(12);
            $this->assertSame(12, $this->planetData->getEnergyMax());
        }

        /**
         * @covers D_Planet::setSolarSatellitePercent
         * @covers D_Planet::getSolarSatellitePercent
         */
        public function testGetSetSolarSatellitePercent() : void {
            $this->planetData->setSolarSatellitePercent(10);
            $this->assertSame(10, $this->planetData->getSolarSatellitePercent());
        }

        /**
         * @covers D_Planet::setSolarPlantPercent
         * @covers D_Planet::getSolarPlantPercent
         */
        public function testGetSetSolarPlantPercent() : void {
            $this->planetData->setSolarPlantPercent(10);
            $this->assertSame(10, $this->planetData->getSolarPlantPercent());
        }

        /**
         * @covers D_Planet::setBBuildingId
         * @covers D_Planet::getBBuildingId
         */
        public function testGetSetBBuildingId() : void {
            $this->planetData->setBBuildingId(10);
            $this->assertSame(10, $this->planetData->getBBuildingId());
        }

        /**
         * @covers D_Planet::setBBuildingEndtime
         * @covers D_Planet::getBBuildingEndtime
         */
        public function testGetSetBBuildingEndtime() : void {
            $this->planetData->setBBuildingEndtime(10);
            $this->assertSame(10, $this->planetData->getBBuildingEndtime());
        }

        /**
         * @covers D_Planet::setBTechId
         * @covers D_Planet::getBTechId
         */
        public function testGetSetBTechId() : void {
            $this->planetData->setBTechId(10);
            $this->assertSame(10, $this->planetData->getBTechId());
        }

        /**
         * @covers D_Planet::setBTechEndtime
         * @covers D_Planet::getBTechEndtime
         */
        public function testGetSetBTechEndtime() : void {
            $this->planetData->setBTechEndtime(10);
            $this->assertSame(10, $this->planetData->getBTechEndtime());
        }

        /**
         * @covers D_Planet::setBHangarId
         * @covers D_Planet::getBHangarId
         */
        public function testGetSetBHangarId() : void {
            $this->planetData->setBHangarId("203,500;");
            $this->assertSame("203,500;", $this->planetData->getBHangarId());
        }

        /**
         * @covers D_Planet::setBHangarPlus
         * @covers D_Planet::getBHangarPlus
         */
        public function testGetSetBHangarPlus() : void {
            $this->planetData->setBHangarPlus(true);
            $this->assertSame(true, $this->planetData->getBHangarPlus());
        }

        /**
         * @covers D_Planet::setDestroyed
         * @covers D_Planet::getDestroyed
         */
        public function testGetSetDestroyed() : void {
            $this->planetData->setDestroyed(true);
            $this->assertSame(true, $this->planetData->getDestroyed());
        }

    }
