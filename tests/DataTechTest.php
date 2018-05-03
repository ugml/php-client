<?php

    declare(strict_types=1);

    require_once __DIR__.'/config.php';

    require_once dirname(dirname(__FILE__)) . "/core/classes/data/tech.php";

    use PHPUnit\Framework\TestCase;

    /**
     * Class DataPlanetTest
     * @codeCoverageIgnore
     */
    final class DataTechTest extends TestCase {

        private $techData;

        protected function setUp() : void {
            $this->techData = new D_Tech(1,1,1,1,1,1,1,1,1,1,1,1,1,1,1);
        }

        /**
         * @covers D_Tech::setEspionageTech
         * @covers D_Tech::getEspionageTech
         */
        public function testGetSetEspionageTech() : void {
            $this->techData->setEspionageTech(5);
            $this->assertSame(5, $this->techData->getEspionageTech());
        }

        /**
         * @covers D_Tech::setComputerTech
         * @covers D_Tech::getComputerTech
         */
        public function testGetSetComputerTech() : void {
            $this->techData->setComputerTech(5);
            $this->assertSame(5, $this->techData->getComputerTech());
        }

        /**
         * @covers D_Tech::setWeaponTech
         * @covers D_Tech::getWeaponTech
         */
        public function testGetSetWeaponTech() : void {
            $this->techData->setWeaponTech(5);
            $this->assertSame(5, $this->techData->getWeaponTech());
        }

        /**
         * @covers D_Tech::setArmourTech
         * @covers D_Tech::getArmourTech
         */
        public function testGetSetArmourTech() : void {
            $this->techData->setArmourTech(5);
            $this->assertSame(5, $this->techData->getArmourTech());
        }

        /**
         * @covers D_Tech::setShieldingTech
         * @covers D_Tech::getShieldingTech
         */
        public function testGetSetShieldingTech() : void {
            $this->techData->setShieldingTech(5);
            $this->assertSame(5, $this->techData->getShieldingTech());
        }

        /**
         * @covers D_Tech::setEnergyTech
         * @covers D_Tech::getEnergyTech
         */
        public function testGetSetEnergyTech() : void {
            $this->techData->setEnergyTech(5);
            $this->assertSame(5, $this->techData->getEnergyTech());
        }

        /**
         * @covers D_Tech::setHyperspaceTech
         * @covers D_Tech::getHyperspaceTech
         */
        public function testGetSetHyperspaceTech() : void {
            $this->techData->setHyperspaceTech(5);
            $this->assertSame(5, $this->techData->getHyperspaceTech());
        }

        /**
         * @covers D_Tech::setCombustionDriveTech
         * @covers D_Tech::getCombustionDriveTech
         */
        public function testGetSetCombustionDriveTech() : void {
            $this->techData->setCombustionDriveTech(5);
            $this->assertSame(5, $this->techData->getCombustionDriveTech());
        }

        /**
         * @covers D_Tech::setImpulseDriveTech
         * @covers D_Tech::getImpulseDriveTech
         */
        public function testGetSetImpulseDriveTech() : void {
            $this->techData->setImpulseDriveTech(5);
            $this->assertSame(5, $this->techData->getImpulseDriveTech());
        }

        /**
         * @covers D_Tech::setHyperspaceDriveTech
         * @covers D_Tech::getHyperspaceDriveTech
         */
        public function testGetSetHyperspaceDriveTech() : void {
            $this->techData->setHyperspaceDriveTech(5);
            $this->assertSame(5, $this->techData->getHyperspaceDriveTech());
        }

        /**
         * @covers D_Tech::setLaserTech
         * @covers D_Tech::getLaserTech
         */
        public function testGetSetLaserTech() : void {
            $this->techData->setLaserTech(5);
            $this->assertSame(5, $this->techData->getLaserTech());
        }

        /**
         * @covers D_Tech::setIonTech
         * @covers D_Tech::getIonTech
         */
        public function testGetSetIonTech() : void {
            $this->techData->setIonTech(5);
            $this->assertSame(5, $this->techData->getIonTech());
        }

        /**
         * @covers D_Tech::setPlasmaTech
         * @covers D_Tech::getPlasmaTech
         */
        public function testGetSetPlasmaTech() : void {
            $this->techData->setPlasmaTech(5);
            $this->assertSame(5, $this->techData->getPlasmaTech());
        }

        /**
         * @covers D_Tech::setIntergalacticResearchTech
         * @covers D_Tech::getIntergalacticResearchTech
         */
        public function testGetSetIntergalacticResearchTech() : void {
            $this->techData->setIntergalacticResearchTech(5);
            $this->assertSame(5, $this->techData->getIntergalacticResearchTech());
        }

        /**
         * @covers D_Tech::setGravitonTech
         * @covers D_Tech::getGravitonTech
         */
        public function testGetSetGravitonTech() : void {
            $this->techData->setGravitonTech(5);
            $this->assertSame(5, $this->techData->getGravitonTech());
        }

    }
