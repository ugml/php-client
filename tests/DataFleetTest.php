<?php

    declare(strict_types=1);

    require_once __DIR__.'/config.php';

    require_once dirname(dirname(__FILE__)) . "/core/classes/data/fleet.php";

    use PHPUnit\Framework\TestCase;

    /**
     * Class DataFleetTest
     * @codeCoverageIgnore
     */
    class DataFleetTest extends TestCase {

        private $fleetData;

        protected function setUp() : void {
            $this->fleetData = new D_Fleet(1,1,1,1,1,1,1,1,1,1,1,1,1,1);
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
    }
