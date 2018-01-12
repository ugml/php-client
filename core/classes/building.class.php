<?php

    declare(strict_types=1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class Building {

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

        public function printBuilding() {
            echo '<pre>';
            print_r($this);
            echo '</pre>';
        }
        
        public function __construct(int $bmetal_mine, int $bcrystal_mine, int $bdeuterium_synthesizer, int $bsolar_plant, int $bfusion_reactor, int $brobotic_factory, int $bnanite_factory, 
                            int $bshipyard, int $bmetal_storage, int $bcrystal_storage, int $bdeuterium_storage, int $bresearch_lab, int $bterraformer, int $balliance_depot, int $bmissile_silo) {
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

        public function getMetalMine() : int
        {
            return $this->metal_mine;
        }

        public function setMetalMine($metal_mine)
        {
            $this->metal_mine = $metal_mine;
        }

        public function getCrystalMine() : int
        {
            return $this->crystal_mine;
        }

        public function setCrystalMine($crystal_mine)
        {
            $this->crystal_mine = $crystal_mine;
        }

        public function getDeuteriumSynthesizer() : int
        {
            return $this->deuterium_synthesizer;
        }

        public function setDeuteriumSynthesizer($deuterium_synthesizer)
        {
            $this->deuterium_synthesizer = $deuterium_synthesizer;
        }

        public function getSolarPlant() : int
        {
            return $this->solar_plant;
        }

        public function setSolarPlant($solar_plant)
        {
            $this->solar_plant = $solar_plant;
        }

        public function getFusionReactor() : int
        {
            return $this->fusion_reactor;
        }

        public function setFusionReactor($fusion_reactor)
        {
            $this->fusion_reactor = $fusion_reactor;
        }

        public function getRoboticFactory() : int
        {
            return $this->robotic_factory;
        }

        /**
         * @param mixed $robotic_factory
         */
        public function setRoboticFactory($robotic_factory)
        {
            $this->robotic_factory = $robotic_factory;
        }

        /**
         * @return mixed
         */
        public function getNaniteFactory() : int
        {
            return $this->nanite_factory;
        }

        /**
         * @param mixed $nanite_factory
         */
        public function setNaniteFactory($nanite_factory)
        {
            $this->nanite_factory = $nanite_factory;
        }

        /**
         * @return mixed
         */
        public function getShipyard() : int
        {
            return $this->shipyard;
        }

        /**
         * @param mixed $shipyard
         */
        public function setShipyard($shipyard)
        {
            $this->shipyard = $shipyard;
        }

        /**
         * @return mixed
         */
        public function getMetalStorage() : int
        {
            return $this->metal_storage;
        }

        /**
         * @param mixed $metal_storage
         */
        public function setMetalStorage($metal_storage)
        {
            $this->metal_storage = $metal_storage;
        }

        /**
         * @return mixed
         */
        public function getCrystalStorage() : int
        {
            return $this->crystal_storage;
        }

        /**
         * @param mixed $crystal_storage
         */
        public function setCrystalStorage($crystal_storage)
        {
            $this->crystal_storage = $crystal_storage;
        }

        /**
         * @return mixed
         */
        public function getDeuteriumStorage() : int
        {
            return $this->deuterium_storage;
        }

        /**
         * @param mixed $deuterium_storage
         */
        public function setDeuteriumStorage($deuterium_storage)
        {
            $this->deuterium_storage = $deuterium_storage;
        }

        /**
         * @return mixed
         */
        public function getResearchLab() : int
        {
            return $this->research_lab;
        }

        /**
         * @param mixed $research_lab
         */
        public function setResearchLab($research_lab)
        {
            $this->research_lab = $research_lab;
        }

        /**
         * @return mixed
         */
        public function getTerraformer() : int
        {
            return $this->terraformer;
        }

        /**
         * @param mixed $terraformer
         */
        public function setTerraformer($terraformer)
        {
            $this->terraformer = $terraformer;
        }

        /**
         * @return mixed
         */
        public function getAllianceDepot() : int
        {
            return $this->alliance_depot;
        }

        /**
         * @param mixed $alliance_depot
         */
        public function setAllianceDepot($alliance_depot)
        {
            $this->alliance_depot = $alliance_depot;
        }

        /**
         * @return mixed
         */
        public function getMissileSilo() : int
        {
            return $this->missile_silo;
        }

        /**
         * @param mixed $missile_silo
         */
        public function setMissileSilo($missile_silo)
        {
            $this->missile_silo = $missile_silo;
        }

        
    }
