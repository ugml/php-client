<?php

    declare(strict_types = 1);

    use PHPUnit\Framework\TestCase;

    /**
     * Class DataPlanetTest
     * @covers D_Tech::__construct
     * @codeCoverageIgnore
     */
    final class DataTechTest extends TestCase {

        private $techData;

        protected function setUp() : void {
            $this->techData = new D_Tech(101,102,103,104,105,106,107,108,109,110,111,112,113,114,115);
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

        /**
         * @covers D_Tech::getTechByID
         */
        public function testGetTechByID() : void {

            $this->assertSame(-1, $this->techData->getTechByID(0));
            $this->assertSame(101, $this->techData->getTechByID(101));
            $this->assertSame(102, $this->techData->getTechByID(102));
            $this->assertSame(103, $this->techData->getTechByID(103));
            $this->assertSame(104, $this->techData->getTechByID(104));
            $this->assertSame(105, $this->techData->getTechByID(105));
            $this->assertSame(106, $this->techData->getTechByID(106));
            $this->assertSame(107, $this->techData->getTechByID(107));
            $this->assertSame(108, $this->techData->getTechByID(108));
            $this->assertSame(109, $this->techData->getTechByID(109));
            $this->assertSame(110, $this->techData->getTechByID(110));
            $this->assertSame(111, $this->techData->getTechByID(111));
            $this->assertSame(112, $this->techData->getTechByID(112));
            $this->assertSame(113, $this->techData->getTechByID(113));
            $this->assertSame(114, $this->techData->getTechByID(114));
            $this->assertSame(115, $this->techData->getTechByID(115));
            $this->assertSame(-1, $this->techData->getTechByID(116));
        }

        /**
         * @covers D_Tech::getTechByID
         * @covers D_Tech::setTechByID
         */
        public function testSetTechByID() : void {

            $this->techData->setTechByID(101,101);
            $this->assertSame(101, $this->techData->getEspionageTech());

            $this->techData->setTechByID(102,102);
            $this->assertSame(102, $this->techData->getComputerTech());

            $this->techData->setTechByID(103,103);
            $this->assertSame(103, $this->techData->getWeaponTech());

            $this->techData->setTechByID(104,104);
            $this->assertSame(104, $this->techData->getArmourTech());

            $this->techData->setTechByID(105,105);
            $this->assertSame(105, $this->techData->getShieldingTech());

            $this->techData->setTechByID(106,106);
            $this->assertSame(106, $this->techData->getEnergyTech());

            $this->techData->setTechByID(107,107);
            $this->assertSame(107, $this->techData->getHyperspaceTech());

            $this->techData->setTechByID(108,108);
            $this->assertSame(108, $this->techData->getCombustionDriveTech());

            $this->techData->setTechByID(109,109);
            $this->assertSame(109, $this->techData->getImpulseDriveTech());

            $this->techData->setTechByID(110,110);
            $this->assertSame(110, $this->techData->getHyperspaceDriveTech());

            $this->techData->setTechByID(111,111);
            $this->assertSame(111, $this->techData->getLaserTech());

            $this->techData->setTechByID(112,112);
            $this->assertSame(112, $this->techData->getIonTech());

            $this->techData->setTechByID(113,113);
            $this->assertSame(113, $this->techData->getPlasmaTech());

            $this->techData->setTechByID(114,114);
            $this->assertSame(114, $this->techData->getIntergalacticResearchTech());

            $this->techData->setTechByID(115,115);
            $this->assertSame(115, $this->techData->getGravitonTech());
        }

    }
