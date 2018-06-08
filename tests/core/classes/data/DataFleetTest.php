<?php

    declare(strict_types = 1);
    use PHPUnit\Framework\TestCase;

    /**
     * Class DataFleetTest
     * @covers D_Fleet::__construct
     * @codeCoverageIgnore
     */
    class DataFleetTest extends TestCase {

        private $fleetData;

        protected function setUp() : void {
            $this->fleetData = new D_Fleet(1,2,3,4,5,6,7,8,9,10,11,12,13,14);
        }

        /**
         * @covers D_Fleet::setBomber
         * @covers D_Fleet::getBomber
         */
        public function testGetSetBomber() {
            $this->fleetData->setBomber(5);
            $this->assertSame(5, $this->fleetData->getBomber());
        }

        /**
         * @covers D_Fleet::setBattlecruiser
         * @covers D_Fleet::getBattlecruiser
         */
        public function testGetSetBattlecruiser() {
            $this->fleetData->setBattlecruiser(5);
            $this->assertSame(5, $this->fleetData->getBattlecruiser());
        }

        /**
         * @covers D_Fleet::setLargeCargoShip
         * @covers D_Fleet::getLargeCargoShip
         */
        public function testGetSetLargeCargoShip() {
            $this->fleetData->setLargeCargoShip(5);
            $this->assertSame(5, $this->fleetData->getLargeCargoShip());
        }

        /**
         * @covers D_Fleet::setColonyShip
         * @covers D_Fleet::getColonyShip
         */
        public function testGetSetColonyShip() {
            $this->fleetData->setColonyShip(5);
            $this->assertSame(5, $this->fleetData->getColonyShip());
        }

        /**
         * @covers D_Fleet::setSolarSatellite
         * @covers D_Fleet::getSolarSatellite
         */
        public function testGetSetSolarSatellite() {
            $this->fleetData->setSolarSatellite(5);
            $this->assertSame(5, $this->fleetData->getSolarSatellite());
        }

        /**
         * @covers D_Fleet::setRecycler
         * @covers D_Fleet::getRecycler
         */
        public function testGetSetRecycler() {
            $this->fleetData->setRecycler(5);
            $this->assertSame(5, $this->fleetData->getRecycler());
        }

        /**
         * @covers D_Fleet::setDestroyer
         * @covers D_Fleet::getDestroyer
         */
        public function testGetSetDestroyer() {
            $this->fleetData->setDestroyer(5);
            $this->assertSame(5, $this->fleetData->getDestroyer());
        }

        /**
         * @covers D_Fleet::setSmallCargoShip
         * @covers D_Fleet::getSmallCargoShip
         */
        public function testGetSetSmallCargoShip() {
            $this->fleetData->setSmallCargoShip(5);
            $this->assertSame(5, $this->fleetData->getSmallCargoShip());
        }

        /**
         * @covers D_Fleet::setLightFighter
         * @covers D_Fleet::getLightFighter
         */
        public function testGetSetLightFighter() {
            $this->fleetData->setLightFighter(5);
            $this->assertSame(5, $this->fleetData->getLightFighter());
        }

        /**
         * @covers D_Fleet::setDeathstar
         * @covers D_Fleet::getDeathstar
         */
        public function testGetSetDeathstar() {
            $this->fleetData->setDeathstar(5);
            $this->assertSame(5, $this->fleetData->getDeathstar());
        }

        /**
         * @covers D_Fleet::setHeavyFighter
         * @covers D_Fleet::getHeavyFighter
         */
        public function testGetSetHeavyFighter() {
            $this->fleetData->setHeavyFighter(5);
            $this->assertSame(5, $this->fleetData->getHeavyFighter());
        }

        /**
         * @covers D_Fleet::setBattleship
         * @covers D_Fleet::getBattleship
         */
        public function testGetSetBattleship() {
            $this->fleetData->setBattleship(5);
            $this->assertSame(5, $this->fleetData->getBattleship());
        }

        /**
         * @covers D_Fleet::setEspionageProbe
         * @covers D_Fleet::getEspionageProbe
         */
        public function testGetSetEspionageProbe() {
            $this->fleetData->setEspionageProbe(5);
            $this->assertSame(5, $this->fleetData->getEspionageProbe());
        }

        /**
         * @covers D_Fleet::setCruiser
         * @covers D_Fleet::getCruiser
         */
        public function testGetSetCruiser() {
            $this->fleetData->setCruiser(5);
            $this->assertSame(5, $this->fleetData->getCruiser());
        }

        /**
         * @covers D_Fleet::getFleetByID
         */
        public function testGetFleetByID() : void {

            $this->assertSame(-1, $this->fleetData->getFleetByID(0));
            $this->assertSame(1, $this->fleetData->getFleetByID(201));
            $this->assertSame(2, $this->fleetData->getFleetByID(202));
            $this->assertSame(3, $this->fleetData->getFleetByID(203));
            $this->assertSame(4, $this->fleetData->getFleetByID(204));
            $this->assertSame(5, $this->fleetData->getFleetByID(205));
            $this->assertSame(6, $this->fleetData->getFleetByID(206));
            $this->assertSame(7, $this->fleetData->getFleetByID(207));
            $this->assertSame(8, $this->fleetData->getFleetByID(208));
            $this->assertSame(9, $this->fleetData->getFleetByID(209));
            $this->assertSame(10, $this->fleetData->getFleetByID(210));
            $this->assertSame(11, $this->fleetData->getFleetByID(211));
            $this->assertSame(12, $this->fleetData->getFleetByID(212));
            $this->assertSame(13, $this->fleetData->getFleetByID(213));
            $this->assertSame(14, $this->fleetData->getFleetByID(214));
            $this->assertSame(-1, $this->fleetData->getFleetByID(215));
            
        }

        /**
         * @covers D_Fleet::getFleetByID
         * @covers D_Fleet::setFleetByID
         */
        public function testSetFleetByID() : void {

            $this->fleetData->setFleetByID(201,201);
            $this->assertSame(201, $this->fleetData->getSmallCargoShip());

            $this->fleetData->setFleetByID(202,202);
            $this->assertSame(202, $this->fleetData->getLargeCargoShip());

            $this->fleetData->setFleetByID(203,203);
            $this->assertSame(203, $this->fleetData->getLightFighter());

            $this->fleetData->setFleetByID(204,204);
            $this->assertSame(204, $this->fleetData->getHeavyFighter());

            $this->fleetData->setFleetByID(205,205);
            $this->assertSame(205, $this->fleetData->getCruiser());

            $this->fleetData->setFleetByID(206,206);
            $this->assertSame(206, $this->fleetData->getBattleship());

            $this->fleetData->setFleetByID(207,207);
            $this->assertSame(207, $this->fleetData->getColonyShip());

            $this->fleetData->setFleetByID(208,208);
            $this->assertSame(208, $this->fleetData->getRecycler());

            $this->fleetData->setFleetByID(209,209);
            $this->assertSame(209, $this->fleetData->getEspionageProbe());

            $this->fleetData->setFleetByID(210,210);
            $this->assertSame(210, $this->fleetData->getBomber());

            $this->fleetData->setFleetByID(211,211);
            $this->assertSame(211, $this->fleetData->getSolarSatellite());

            $this->fleetData->setFleetByID(212,212);
            $this->assertSame(212, $this->fleetData->getDestroyer());

            $this->fleetData->setFleetByID(213,213);
            $this->assertSame(213, $this->fleetData->getBattlecruiser());

            $this->fleetData->setFleetByID(214,214);
            $this->assertSame(214, $this->fleetData->getDeathstar());

        }
    }
