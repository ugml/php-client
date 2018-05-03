<?php

    declare(strict_types=1);

    require_once __DIR__.'/config.php';

    require_once dirname(dirname(__FILE__)) . "/core/classes/data/defense.php";

    use PHPUnit\Framework\TestCase;

    /**
     * Class DataDefenseTest
     * @codeCoverageIgnore
     */
    final class DataDefenseTest extends TestCase {

        private $defenseData;

        protected function setUp() : void {
            $this->defenseData = new D_Defense(1,1,1,1,1,1,1,1,1,1);
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

    }
