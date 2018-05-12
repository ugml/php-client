<?php

    declare(strict_types = 1);

    if (!defined('INSIDE')) {
        define('INSIDE', true);
    }
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/core/config.sample.php';

    Config::init();

    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/data/galaxy.php";

    use PHPUnit\Framework\TestCase;

    /**
     * Class DataGalaxyTest
     * @covers D_Galaxy::__construct
     * @codeCoverageIgnore
     */
    final class DataGalaxyTest extends TestCase {

        private $galaxyData;

        protected function setUp() : void {
            $this->galaxyData = new D_Galaxy(1, 1);
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
