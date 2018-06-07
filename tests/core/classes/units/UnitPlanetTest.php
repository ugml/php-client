<?php

    declare(strict_types = 1);

    use PHPUnit\Framework\TestCase;

    /**
     * Class UnitPlanetTest
     * @covers U_Planet::__construct
     * @codeCoverageIgnore
     */
    final class UnitPlanetTest extends TestCase {

        private $planet;

        /**
         * @covers U_Planet::getTotalEnergyProduction
         * @covers U_Planet::getTotalEnergyConsumption
         * @covers U_Planet::calculateMetalProduction
         * @covers U_Planet::calculateCrystalProduction
         * @covers U_Planet::calculateDeuteriumProduction
         */
        public function testGetTotalEnergyProduction() : void {

            $this->assertSame(0, 0);

        }

        /**
         * @covers U_Planet::getPlanetID
         * @covers U_Planet::setPlanetID
         */
        public function testSetPlanetID() : void  {
            $this->planet->setPlanetID(5);
            $this->assertSame(5, $this->planet->getPlanetID());
        }

        /**
         * @covers U_Planet::getOwnerID
         * @covers U_Planet::setOwnerID
         */
        public function testSetOwnerID() : void {
            $this->planet->setOwnerID(5);
            $this->assertSame(5, $this->planet->getOwnerID());
        }

        /**
         * @covers U_Planet::getName
         * @covers U_Planet::setName
         */
        public function testSetName() : void {
            $this->planet->setName("Testplanet");
            $this->assertSame("Testplanet", $this->planet->getName());
        }

        /**
         * @covers U_Planet::getGalaxy
         * @covers U_Planet::setGalaxy()
         */
        public function testSetGalaxy() : void {
            $this->planet->setGalaxy(5);
            $this->assertSame(5, $this->planet->getGalaxy());
        }

        /**
         * @covers U_Planet::getSystem()
         * @covers U_Planet::setSystem()
         */
        public function testSetSystem() : void {
            $this->planet->setSystem(5);
            $this->assertSame(5, $this->planet->getSystem());
        }

        /**
         * @covers U_Planet::getPlanet()
         * @covers U_Planet::setPlanet()
         */
        public function testSetPlanet() : void {
            $this->planet->setPlanet(5);
            $this->assertSame(5, $this->planet->getPlanet());
        }

        /**
         * @covers U_Planet::getLastUpdate()
         * @covers U_Planet::setLastUpdate()
         */
        public function testSetLastUpdate() : void {
            $this->planet->setLastUpdate(5);
            $this->assertSame(5, $this->planet->getLastUpdate());
        }

        /**
         * @covers U_Planet::getPlanetType()
         * @covers U_Planet::setPlanetType()
         */
        public function testSetPlanetType() : void {
            $this->planet->setPlanetType(2);
            $this->assertSame(2, $this->planet->getPlanetType());
        }

        /**
         * @covers U_Planet::getImage()
         * @covers U_Planet::setImage()
         */
        public function testSetImage() : void {
            $this->planet->setImage("someBeautifulImage.jpg");
            $this->assertSame("someBeautifulImage.jpg", $this->planet->getImage());
        }

        /**
         * @covers U_Planet::getDiameter()
         * @covers U_Planet::setDiameter()
         */
        public function testSetDiameter() : void {
            $this->planet->setDiameter(3586000);
            $this->assertSame(3586000, $this->planet->getDiameter());
        }

        /**
         * @covers U_Planet::getFieldsCurrent()
         * @covers U_Planet::setFieldsCurrent()
         */
        public function testSetFieldsCurrent() : void {
            $this->planet->setFieldsCurrent(5);
            $this->assertSame(5, $this->planet->getFieldsCurrent());
        }

        /**
         * @covers U_Planet::getFieldsMax()
         * @covers U_Planet::setFieldsMax()
         */
        public function testSetFieldsMax() : void {
            $this->planet->setFieldsMax(5);
            $this->assertSame(5, $this->planet->getFieldsMax());
        }

        /**
         * @covers U_Planet::getTempMin()
         * @covers U_Planet::setTempMin()
         */
        public function testSetTempMin() : void {
            $this->planet->setTempMin(5);
            $this->assertSame(5, $this->planet->getTempMin());
        }

        /**
         * @covers U_Planet::getTempMax()
         * @covers U_Planet::setTempMax()
         */
        public function testSetTempMax() : void {
            $this->planet->setTempMax(5);
            $this->assertSame(5, $this->planet->getTempMax());
        }

        /**
         * @covers U_Planet::getMetal()
         * @covers U_Planet::setMetal()
         */
        public function testSetMetal() : void {
            $this->planet->setMetal(5);
            $this->assertSame(5, $this->planet->getMetal());
        }

        /**
         * @covers U_Planet::getCrystal()
         * @covers U_Planet::setCrystal()
         */
        public function testSetCrystal() : void {
            $this->planet->setCrystal(5);
            $this->assertSame(5, $this->planet->getCrystal());
        }

        /**
         * @covers U_Planet::getDeuterium()
         * @covers U_Planet::setDeuterium()
         */
        public function testSetDeuterium() : void {
            $this->planet->setDeuterium(5);
            $this->assertSame(5, $this->planet->getDeuterium());
        }

        /**
         * @covers U_Planet::getEnergyUsed()
         * @covers U_Planet::setEnergyUsed()
         */
        public function testSetEnergyUsed() : void {
            $this->planet->setEnergyUsed(5);
            $this->assertSame(5, $this->planet->getEnergyUsed());
        }

        /**
         * @covers U_Planet::getEnergyMax()
         * @covers U_Planet::setEnergyMax()
         */
        public function testSetEnergyMax() : void {
            $this->planet->setEnergyMax(5);
            $this->assertSame(5, $this->planet->getEnergyMax());
        }

        /**
         * @covers U_Planet::getSolarPlantPercent()
         * @covers U_Planet::setSolarPlantPercent()
         */
        public function testSetSolarPlantPercent() : void {
            $this->planet->setSolarPlantPercent(10);
            $this->assertSame(10, $this->planet->getSolarPlantPercent());
        }

        /**
         * @covers U_Planet::getSolarSatellitePercent()
         * @covers U_Planet::setSolarSatellitePercent()
         */
        public function testSetSolarSatellitePercent() : void {
            $this->planet->setSolarSatellitePercent(10);
            $this->assertSame(10, $this->planet->getSolarSatellitePercent());
        }

        /**
         * @covers U_Planet::getBBuildingId()
         * @covers U_Planet::setBBuildingId()
         */
        public function testSetBBuildingId() : void {
            $this->planet->setBBuildingId(5);
            $this->assertSame(5, $this->planet->getBBuildingId());
        }

        /**
         * @covers U_Planet::getBBuildingEndtime()
         * @covers U_Planet::setBBuildingEndtime()
         */
        public function testSetBBuildingEndtime() : void {
            $this->planet->setBBuildingEndtime(5);
            $this->assertSame(5, $this->planet->getBBuildingEndtime());
        }

        /**
         * @covers U_Planet::getBTechId()
         * @covers U_Planet::setBTechId()
         */
        public function testSetBTechId() : void {
            $this->planet->setBTechId(5);
            $this->assertSame(5, $this->planet->getBTechId());
        }

        /**
         * @covers U_Planet::getBHangarStartTime()
         * @covers U_Planet::setBHangarStartTime()
         */
        public function testSetBHangarStartTime() : void {
            $this->planet->setBHangarStartTime(5);
            $this->assertSame(5, $this->planet->getBHangarStartTime());
        }

        /**
         * @covers U_Planet::getBTechEndtime()
         * @covers U_Planet::setBTechEndtime()
         */
        public function testSetBTechEndtime() : void {
            $this->planet->setBTechEndtime(5);
            $this->assertSame(5, $this->planet->getBTechEndtime());
        }

        /**
         * @covers U_Planet::getBHangarId()
         * @covers U_Planet::setBHangarId()
         */
        public function testSetBHangarId() : void {
            $this->planet->setBHangarId(5);
            $this->assertSame(5, $this->planet->getBHangarId());
        }

        /**
         * @covers U_Planet::getBHangarPlus()
         * @covers U_Planet::setBHangarPlus()
         */
        public function testSetBHangarPlus() : void {
            $this->planet->setBHangarPlus(true);
            $this->assertSame(true, $this->planet->getBHangarPlus());
        }

        /**
         * @covers U_Planet::getDestroyed()
         * @covers U_Planet::setDestroyed()
         */
        public function testSetDestroyed() : void {
            $this->planet->setDestroyed(true);
            $this->assertSame(true, $this->planet->getDestroyed());
        }


        /**
         * @covers U_Planet::__construct
         */
        protected function setUp() : void {
            $this->planet = new U_Planet(1,1,"Heimatplanet",1,1,1,time(),0,"asdf",1,0,180,-12,36,100000,100000,100000,0,100,100,100,100,100,100,100,0,0,0,0,0,"",false,false);
        }

    }
