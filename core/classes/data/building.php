<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    /**
     * This class maps the 'buildings'-table to an php object and contains
     * all necessary getters and setters.
     */
    class D_Building {

        /** @var int Level of Metal Mine */
        private $metal_mine;

        /** @var int Level of Crystal Mine */
        private $crystal_mine;

        /** @var int Level of Deuterium Synthesizer */
        private $deuterium_synthesizer;

        /** @var int Level of Solar Plant */
        private $solar_plant;

        /** @var int Level of Fusion Reactor */
        private $fusion_reactor;

        /** @var int Level of Robotic Factory */
        private $robotic_factory;

        /** @var int Level of Nanite Factory */
        private $nanite_factory;

        /** @var int Level of Shipyard */
        private $shipyard;

        /** @var int Level of Metal Storage */
        private $metal_storage;

        /** @var int Level of Crystal Storage */
        private $crystal_storage;

        /** @var int Level of Deuterium Storage */
        private $deuterium_storage;

        /** @var int Level of Research Lab */
        private $research_lab;

        /** @var int Level of Terraformer */
        private $terraformer;

        /** @var int Level of Alliance Depot */
        private $alliance_depot;

        /** @var int Level of Missile Silo */
        private $missile_silo;

        /**
         * D_Building constructor.
         * The parameters are the level of the building
         * @param int $bmetal_mine
         * @param int $bcrystal_mine
         * @param int $bdeuterium_synthesizer
         * @param int $bsolar_plant
         * @param int $bfusion_reactor
         * @param int $brobotic_factory
         * @param int $bnanite_factory
         * @param int $bshipyard
         * @param int $bmetal_storage
         * @param int $bcrystal_storage
         * @param int $bdeuterium_storage
         * @param int $bresearch_lab
         * @param int $bterraformer
         * @param int $balliance_depot
         * @param int $bmissile_silo
         */
        public function __construct(int $bmetal_mine, int $bcrystal_mine, int $bdeuterium_synthesizer,
            int $bsolar_plant, int $bfusion_reactor, int $brobotic_factory, int $bnanite_factory,
            int $bshipyard, int $bmetal_storage, int $bcrystal_storage, int $bdeuterium_storage, int $bresearch_lab,
            int $bterraformer, int $balliance_depot, int $bmissile_silo) {

            $this->metal_mine = $bmetal_mine;
            $this->crystal_mine = $bcrystal_mine;
            $this->deuterium_synthesizer = $bdeuterium_synthesizer;
            $this->solar_plant = $bsolar_plant;
            $this->fusion_reactor = $bfusion_reactor;
            $this->robotic_factory = $brobotic_factory;
            $this->nanite_factory = $bnanite_factory;
            $this->shipyard = $bshipyard;
            $this->metal_storage = $bmetal_storage;
            $this->crystal_storage = $bcrystal_storage;
            $this->deuterium_storage = $bdeuterium_storage;
            $this->research_lab = $bresearch_lab;
            $this->terraformer = $bterraformer;
            $this->alliance_depot = $balliance_depot;
            $this->missile_silo = $bmissile_silo;
        }

        /**
         * Prints the object to the page
         * @codeCoverageIgnore
         */
        public function print() : void {
            echo '<pre>';
            print_r($this);
            echo '</pre>';
        }

        /**
         * Returns the current level
         * @return int the current level
         */
        public function getMetalMine() : int {
            return $this->metal_mine;
        }

        /**
         * Sets the current level
         * @param int $level the new level
         */
        public function setMetalMine(int $level) : void {

            if ($level >= 0) {
                $this->metal_mine = $level;
            }

        }

        /**
         * Returns the current level
         * @return int the current level
         */
        public function getCrystalMine() : int {

            return $this->crystal_mine;
        }

        /**
         * Sets the current level
         * @param int $level the new level
         */
        public function setCrystalMine(int $level) : void {
            if ($level >= 0) {
                $this->crystal_mine = $level;
            }
        }

        /**
         * Returns the current level
         * @return int the current level
         */
        public function getDeuteriumSynthesizer() : int {

            return $this->deuterium_synthesizer;
        }

        /**
         * Sets the current level
         * @param int $level the new level
         */
        public function setDeuteriumSynthesizer(int $level) : void {

            if ($level >= 0) {
                $this->deuterium_synthesizer = $level;
            }

        }

        /**
         * Returns the current level
         * @return int the current level
         */
        public function getSolarPlant() : int {

            return $this->solar_plant;
        }

        /**
         * Sets the current level
         * @param int $level the new level
         */
        public function setSolarPlant(int $level) : void {

            if ($level >= 0) {
                $this->solar_plant = $level;
            }
        }

        /**
         * Returns the current level
         * @return int the current level
         */
        public function getFusionReactor() : int {

            return $this->fusion_reactor;
        }

        /**
         * Sets the current level
         * @param int $level the new level
         */
        public function setFusionReactor(int $level) : void {

            if ($level >= 0) {
                $this->fusion_reactor = $level;
            }
        }

        /**
         * Returns the current level
         * @return int the current level
         */
        public function getRoboticFactory() : int {

            return $this->robotic_factory;
        }

        /**
         * Sets the current level
         * @param int $level the new level
         */
        public function setRoboticFactory(int $level) : void {

            if ($level >= 0) {
                $this->robotic_factory = $level;
            }
        }

        /**
         * Returns the current level
         * @return int the current level
         */
        public function getNaniteFactory() : int {

            return $this->nanite_factory;
        }

        /**
         * Sets the current level
         * @param int $level the new level
         */
        public function setNaniteFactory(int $level) : void {

            if ($level >= 0) {
                $this->nanite_factory = $level;
            }
        }

        /**
         * Returns the current level
         * @return int the current level
         */
        public function getShipyard() : int {

            return $this->shipyard;
        }

        /**
         * Sets the current level
         * @param int $level the new level
         */
        public function setShipyard(int $level) : void {

            if ($level >= 0) {
                $this->shipyard = $level;
            }
        }

        /**
         * Returns the current level
         * @return int the current level
         */
        public function getMetalStorage() : int {

            return $this->metal_storage;
        }

        /**
         * Sets the current level
         * @param int $level the new level
         */
        public function setMetalStorage(int $level) : void {

            if ($level >= 0) {
                $this->metal_storage = $level;
            }
        }

        /**
         * Returns the current level
         * @return int the current level
         */
        public function getCrystalStorage() : int {

            return $this->crystal_storage;
        }

        /**
         * Sets the current level
         * @param int $level the new level
         */
        public function setCrystalStorage(int $level) : void {

            if ($level >= 0) {
                $this->crystal_storage = $level;
            }
        }

        /**
         * Returns the current level
         * @return int the current level
         */
        public function getDeuteriumStorage() : int {

            return $this->deuterium_storage;
        }

        /**
         * Sets the current level
         * @param int $level the new level
         */
        public function setDeuteriumStorage(int $level) : void {

            if ($level >= 0) {
                $this->deuterium_storage = $level;
            }
        }

        /**
         * Returns the current level
         * @return int the current level
         */
        public function getResearchLab() : int {

            return $this->research_lab;
        }

        /**
         * Sets the current level
         * @param int $level the new level
         */
        public function setResearchLab(int $level) : void {

            if ($level >= 0) {
                $this->research_lab = $level;
            }
        }

        /**
         * Returns the current level
         * @return int the current level
         */
        public function getTerraformer() : int {

            return $this->terraformer;
        }

        /**
         * Sets the current level
         * @param int $level the new level
         */
        public function setTerraformer(int $level) : void {

            if ($level >= 0) {
                $this->terraformer = $level;
            }

        }

        /**
         * Returns the current level
         * @return int the current level
         */
        public function getAllianceDepot() : int {

            return $this->alliance_depot;
        }

        /**
         * Sets the current level
         * @param int $level the new level
         */
        public function setAllianceDepot(int $level) : void {

            if ($level >= 0) {
                $this->alliance_depot = $level;
            }

        }

        /**
         * Returns the current level
         * @return int the current level
         */
        public function getMissileSilo() : int {

            return $this->missile_silo;
        }

        /**
         * Sets the current level
         * @param int $level the new level
         */
        public function setMissileSilo(int $level) : void {

            if ($level >= 0) {
                $this->missile_silo = $level;
            }
        }

        /**
         * Return the level of the building, given its id
         * @param int $id the building id
         * @return int the level of the building
         */
        public function getBuildingByID(int $id) : int {

            switch ($id) {
                case 1:
                    return $this->getMetalMine();
                    break;
                case 2:
                    return $this->getCrystalMine();
                    break;
                case 3:
                    return $this->getDeuteriumSynthesizer();
                    break;
                case 4:
                    return $this->getSolarPlant();
                    break;
                case 5:
                    return $this->getFusionReactor();
                    break;
                case 6:
                    return $this->getRoboticFactory();
                    break;
                case 7:
                    return $this->getNaniteFactory();
                    break;
                case 8:
                    return $this->getShipyard();
                    break;
                case 9:
                    return $this->getMetalStorage();
                    break;
                case 10:
                    return $this->getCrystalStorage();
                    break;
                case 11:
                    return $this->getDeuteriumStorage();
                    break;
                case 12:
                    return $this->getResearchLab();
                    break;
                case 13:
                    return $this->getTerraformer();
                    break;
                case 14:
                    return $this->getAllianceDepot();
                    break;
                case 15:
                    return $this->getMissileSilo();
                    break;
            }

            return -1;
        }

        /**
         * Sets the level of the building, given its id and new level
         * @param int $id    the id of the building
         * @param int $level the new level of the building
         */
        public function setBuildingByID(int $id, int $level) : void {
            switch ($id) {
                case 1:
                    $this->setMetalMine($level);
                    break;
                case 2:
                    $this->setCrystalMine($level);
                    break;
                case 3:
                    $this->setDeuteriumSynthesizer($level);
                    break;
                case 4:
                    $this->setSolarPlant($level);
                    break;
                case 5:
                    $this->setFusionReactor($level);
                    break;
                case 6:
                    $this->setRoboticFactory($level);
                    break;
                case 7:
                    $this->setNaniteFactory($level);
                    break;
                case 8:
                    $this->setShipyard($level);
                    break;
                case 9:
                    $this->setMetalStorage($level);
                    break;
                case 10:
                    $this->setCrystalStorage($level);
                    break;
                case 11:
                    $this->setDeuteriumStorage($level);
                    break;
                case 12:
                    $this->setResearchLab($level);
                    break;
                case 13:
                    $this->setTerraformer($level);
                    break;
                case 14:
                    $this->setAllianceDepot($level);
                    break;
                case 15:
                    $this->setMissileSilo($level);
                    break;
            }
        }

    }
