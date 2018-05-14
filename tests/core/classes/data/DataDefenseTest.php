<?php

    declare(strict_types = 1);

    use PHPUnit\Framework\TestCase;

    /**
     * Class DataDefenseTest
     * @covers D_Defense::__construct
     * @codeCoverageIgnore
     */
    final class DataDefenseTest extends TestCase {

        private $defenseData;

        protected function setUp() : void {
            $this->defenseData = new D_Defense(301,302,303,304,305,306,307,308,309,310);
        }

        /**
         * @covers D_Defense::setRocketLauncher
         * @covers D_Defense::getRocketLauncher
         */
        public function testGetSetRocketLauncher() : void {
            $this->defenseData->setRocketLauncher(5);
            $this->assertSame(5, $this->defenseData->getRocketLauncher());
        }

        /**
         * @covers D_Defense::setLightLaser
         * @covers D_Defense::getLightLaser
         */
        public function testGetSetLightLaser() : void {
            $this->defenseData->setLightLaser(5);
            $this->assertSame(5, $this->defenseData->getLightLaser());
        }

        /**
         * @covers D_Defense::setHeavyLaser
         * @covers D_Defense::getHeavyLaser
         */
        public function testGetSetHeavyLaser() : void {
            $this->defenseData->setHeavyLaser(5);
            $this->assertSame(5, $this->defenseData->getHeavyLaser());
        }

        /**
         * @covers D_Defense::setIonCannon
         * @covers D_Defense::getIonCannon
         */
        public function testGetSetIonCannon() : void {
            $this->defenseData->setIonCannon(5);
            $this->assertSame(5, $this->defenseData->getIonCannon());
        }

        /**
         * @covers D_Defense::setGaussCannon
         * @covers D_Defense::getGaussCannon
         */
        public function testGetSetGaussCannon() : void {
            $this->defenseData->setGaussCannon(5);
            $this->assertSame(5, $this->defenseData->getGaussCannon());
        }

        /**
         * @covers D_Defense::setPlasmaTurret
         * @covers D_Defense::getPlasmaTurret
         */
        public function testGetSetPlasmaTurret() : void {
            $this->defenseData->setPlasmaTurret(5);
            $this->assertSame(5, $this->defenseData->getPlasmaTurret());
        }

        /**
         * @covers D_Defense::setSmallShieldDome
         * @covers D_Defense::getSmallShieldDome
         */
        public function testGetSetSmallShieldDome() : void {
            $this->defenseData->setSmallShieldDome(1);
            $this->assertSame(1, $this->defenseData->getSmallShieldDome());
        }

        /**
         * @covers D_Defense::setLargeShieldDome
         * @covers D_Defense::getLargeShieldDome
         */
        public function testGetSetLargeShieldDome() : void {
            $this->defenseData->setLargeShieldDome(1);
            $this->assertSame(1, $this->defenseData->getLargeShieldDome());
        }

        /**
         * @covers D_Defense::setAntiBallisticMissile
         * @covers D_Defense::getAntiBallisticMissile
         */
        public function testGetSetAntiBallisticMissile() : void {
            $this->defenseData->setAntiBallisticMissile(5);
            $this->assertSame(5, $this->defenseData->getAntiBallisticMissile());
        }

        /**
         * @covers D_Defense::setInterplanetaryMissile
         * @covers D_Defense::getInterplanetaryMissile
         */
        public function testGetSetInterplanetaryMissile() : void {
            $this->defenseData->setInterplanetaryMissile(5);
            $this->assertSame(5, $this->defenseData->getInterplanetaryMissile());
        }

        /**
         * @covers D_Defense::getDefenseByID
         */
        public function testGetDefenseByID() : void {

            $this->assertSame(-1, $this->defenseData->getDefenseByID(0));
            $this->assertSame(301, $this->defenseData->getDefenseByID(301));
            $this->assertSame(302, $this->defenseData->getDefenseByID(302));
            $this->assertSame(303, $this->defenseData->getDefenseByID(303));
            $this->assertSame(304, $this->defenseData->getDefenseByID(304));
            $this->assertSame(305, $this->defenseData->getDefenseByID(305));
            $this->assertSame(306, $this->defenseData->getDefenseByID(306));
            $this->assertSame(307, $this->defenseData->getDefenseByID(307));
            $this->assertSame(308, $this->defenseData->getDefenseByID(308));
            $this->assertSame(309, $this->defenseData->getDefenseByID(309));
            $this->assertSame(310, $this->defenseData->getDefenseByID(310));
            $this->assertSame(-1, $this->defenseData->getDefenseByID(311));
        }

        /**
         * @covers D_Defense::getDefenseByID
         * @covers D_Defense::setDefenseByID
         */
        public function testSetDefenseByID() : void {

            $this->defenseData->setDefenseByID(301,301);
            $this->assertSame(301, $this->defenseData->getRocketLauncher());

            $this->defenseData->setDefenseByID(302,302);
            $this->assertSame(302, $this->defenseData->getLightLaser());

            $this->defenseData->setDefenseByID(303,303);
            $this->assertSame(303, $this->defenseData->getHeavyLaser());

            $this->defenseData->setDefenseByID(304,304);
            $this->assertSame(304, $this->defenseData->getGaussCannon());

            $this->defenseData->setDefenseByID(305,305);
            $this->assertSame(305, $this->defenseData->getIonCannon());

            $this->defenseData->setDefenseByID(306,306);
            $this->assertSame(306, $this->defenseData->getPlasmaTurret());

            $this->defenseData->setDefenseByID(307,0);
            $this->assertSame(0, $this->defenseData->getSmallShieldDome());

            $this->defenseData->setDefenseByID(308,1);
            $this->assertSame(1, $this->defenseData->getLargeShieldDome());

            $this->defenseData->setDefenseByID(309,309);
            $this->assertSame(309, $this->defenseData->getAntiBallisticMissile());

            $this->defenseData->setDefenseByID(310,310);
            $this->assertSame(310, $this->defenseData->getInterplanetaryMissile());
        }

    }
