<?php

    declare(strict_types=1);

    require_once __DIR__.'/config.php';

    require_once dirname(dirname(__FILE__)) . "/core/classes/data/galaxy.php";

    use PHPUnit\Framework\TestCase;

    /**
     * Class DataGalaxyTest
     * @codeCoverageIgnore
     */
    final class DataGalaxyTest extends TestCase {

        private $galaxyData;

        protected function setUp() : void {
            $this->galaxyData = new D_Galaxy(1,1);
        }

        /**
         * @covers D_Galaxy::setDebrisMetal
         * @covers D_Galaxy::getDebrisMetal
         */
        public function testGetSetMetalMine() : void {
            $this->galaxyData->setDebrisMetal(500);
            $this->assertSame(500, $this->galaxyData->getDebrisMetal());
        }

        /**
         * @covers D_Galaxy::setDebrisCrystal
         * @covers D_Galaxy::getDebrisCrystal
         */
        public function testGetSetCrystalMine() : void {
            $this->galaxyData->setDebrisCrystal(3356);
            $this->assertSame(3356, $this->galaxyData->getDebrisCrystal());
        }

    }
