<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class Data_Building {

        private $metal_mine;

        private $crystal_mine;

        private $deuterium_synthesizer;

        private $solar_plant;

        private $fusion_reactor;

        private $robotic_factory;

        private $nanite_factory;

        private $shipyard;

        private $metal_storage;

        private $crystal_storage;

        private $deuterium_storage;

        private $research_lab;

        private $terraformer;

        private $alliance_depot;

        private $missile_silo;

        /**
         * BuildingData constructor.
         * parameters are building-levels
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

        public function printBuilding() : void {

            echo '<pre>';
            print_r($this);
            echo '</pre>';
        }

        /**
         * @return int
         */
        public function getMetalMine() : int {

            return $this->metal_mine;
        }

        /**
         * @param $metal_mine
         */
        public function setMetalMine($metal_mine) : void {

            $this->metal_mine = $metal_mine;
        }

        /**
         * @return int
         */
        public function getCrystalMine() : int {

            return $this->crystal_mine;
        }

        /**
         * @param $crystal_mine
         */
        public function setCrystalMine($crystal_mine) : void {

            $this->crystal_mine = $crystal_mine;
        }

        /**
         * @return int
         */
        public function getDeuteriumSynthesizer() : int {

            return $this->deuterium_synthesizer;
        }

        /**
         * @param $deuterium_synthesizer
         */
        public function setDeuteriumSynthesizer($deuterium_synthesizer) : void {

            $this->deuterium_synthesizer = $deuterium_synthesizer;
        }

        /**
         * @return int
         */
        public function getSolarPlant() : int {

            return $this->solar_plant;
        }

        /**
         * @param $solar_plant
         */
        public function setSolarPlant($solar_plant) : void {

            $this->solar_plant = $solar_plant;
        }

        /**
         * @return int
         */
        public function getFusionReactor() : int {

            return $this->fusion_reactor;
        }

        /**
         * @param $fusion_reactor
         */
        public function setFusionReactor($fusion_reactor) : void {

            $this->fusion_reactor = $fusion_reactor;
        }

        /**
         * @return int
         */
        public function getRoboticFactory() : int {

            return $this->robotic_factory;
        }

        /**
         * @param $robotic_factory
         */
        public function setRoboticFactory($robotic_factory) : void {

            $this->robotic_factory = $robotic_factory;
        }

        /**
         * @return int
         */
        public function getNaniteFactory() : int {

            return $this->nanite_factory;
        }

        /**
         * @param $nanite_factory
         */
        public function setNaniteFactory($nanite_factory) : void {

            $this->nanite_factory = $nanite_factory;
        }

        /**
         * @return int
         */
        public function getShipyard() : int {

            return $this->shipyard;
        }

        /**
         * @param $shipyard
         */
        public function setShipyard($shipyard) : void {

            $this->shipyard = $shipyard;
        }

        /**
         * @return int
         */
        public function getMetalStorage() : int {

            return $this->metal_storage;
        }

        /**
         * @param $metal_storage
         */
        public function setMetalStorage($metal_storage) : void {

            $this->metal_storage = $metal_storage;
        }

        /**
         * @return int
         */
        public function getCrystalStorage() : int {

            return $this->crystal_storage;
        }

        /**
         * @param $crystal_storage
         */
        public function setCrystalStorage($crystal_storage) : void {

            $this->crystal_storage = $crystal_storage;
        }

        /**
         * @return int
         */
        public function getDeuteriumStorage() : int {

            return $this->deuterium_storage;
        }

        /**
         * @param $deuterium_storage
         */
        public function setDeuteriumStorage($deuterium_storage) : void {

            $this->deuterium_storage = $deuterium_storage;
        }

        /**
         * @return int
         */
        public function getResearchLab() : int {

            return $this->research_lab;
        }

        /**
         * @param $research_lab
         */
        public function setResearchLab($research_lab) : void {

            $this->research_lab = $research_lab;
        }

        /**
         * @return int
         */
        public function getTerraformer() : int {

            return $this->terraformer;
        }

        /**
         * @param $terraformer
         */
        public function setTerraformer($terraformer) : void {

            $this->terraformer = $terraformer;
        }

        /**
         * @return int
         */
        public function getAllianceDepot() : int {

            return $this->alliance_depot;
        }

        /**
         * @param $alliance_depot
         */
        public function setAllianceDepot($alliance_depot) : void {

            $this->alliance_depot = $alliance_depot;
        }

        /**
         * @return int
         */
        public function getMissileSilo() : int {

            return $this->missile_silo;
        }

        /**
         * @param $missile_silo
         */
        public function setMissileSilo($missile_silo) : void {

            $this->missile_silo = $missile_silo;
        }

    }
