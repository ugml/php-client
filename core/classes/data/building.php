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

        /** @var int Level of Research Lab*/
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
         * @param int $metal_mine the new level
         */
        public function setMetalMine(int $metal_mine) : void {

            $this->metal_mine = $metal_mine;
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
         * @param int $crystal_mine the new level
         */
        public function setCrystalMine(int $crystal_mine) : void {

            $this->crystal_mine = $crystal_mine;
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
         * @param int $deuterium_synthesizer the new level
         */
        public function setDeuteriumSynthesizer(int $deuterium_synthesizer) : void {

            $this->deuterium_synthesizer = $deuterium_synthesizer;
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
         * @param int $solar_plant the new level
         */
        public function setSolarPlant(int $solar_plant) : void {

            $this->solar_plant = $solar_plant;
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
         * @param int $fusion_reactor the new level
         */
        public function setFusionReactor(int $fusion_reactor) : void {

            $this->fusion_reactor = $fusion_reactor;
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
         * @param int $robotic_factory the new level
         */
        public function setRoboticFactory(int $robotic_factory) : void {

            $this->robotic_factory = $robotic_factory;
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
         * @param int $nanite_factory the new level
         */
        public function setNaniteFactory(int $nanite_factory) : void {

            $this->nanite_factory = $nanite_factory;
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
         * @param int $shipyard the new level
         */
        public function setShipyard(int $shipyard) : void {

            $this->shipyard = $shipyard;
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
         * @param int $metal_storage the new level
         */
        public function setMetalStorage(int $metal_storage) : void {

            $this->metal_storage = $metal_storage;
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
         * @param int $crystal_storage the new level
         */
        public function setCrystalStorage(int $crystal_storage) : void {

            $this->crystal_storage = $crystal_storage;
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
         * @param int $deuterium_storage the new level
         */
        public function setDeuteriumStorage(int $deuterium_storage) : void {

            $this->deuterium_storage = $deuterium_storage;
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
         * @param int $research_lab the new level
         */
        public function setResearchLab(int $research_lab) : void {

            $this->research_lab = $research_lab;
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
         * @param int $terraformer the new level
         */
        public function setTerraformer(int $terraformer) : void {

            $this->terraformer = $terraformer;
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
         * @param int $alliance_depot the new level
         */
        public function setAllianceDepot(int $alliance_depot) : void {

            $this->alliance_depot = $alliance_depot;
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
         * @param int $missile_silo the new level
         */
        public function setMissileSilo(int $missile_silo) : void {

            $this->missile_silo = $missile_silo;
        }

    }
