<?php

    declare(strict_types = 1);


    defined('INSIDE') OR exit('No direct script access allowed');

    class Data_Planet {

        private $planetID;

        private $ownerID;

        private $name;

        private $galaxy;

        private $system;

        private $planet;

        private $last_update;

        private $planet_type;

        private $image;

        private $diameter;

        private $fields_current;

        private $fields_max;

        private $temp_min;

        private $temp_max;

        private $metal;

        private $crystal;

        private $deuterium;

        private $energy_used;

        private $energy_max;

        private $metal_mine_percent;

        private $crystal_mine_percent;

        private $deuterium_synthesizer_percent;

        private $solar_plant_percent;

        private $fusion_reactor_percent;

        private $solar_satellite_percent;

        private $b_building_id;

        private $b_building_endtime;

        private $b_tech_id;

        private $b_hangar_start_time;

        private $b_tech_endtime;

        private $b_hangar_id;

        private $b_hangar_plus;

        private $destroyed;

        public function __construct(
            int $pID, int $pownerID, string $pname, int $pgala, int $psystem, int $pplanet, int $plast_update,
            int $pplanet_type, string $pimage,
            int $pdiameter, int $pfields_current, int $pfields_max, int $ptemp_min, int $ptemp_max, float $pmetal,
            float $pcrystal, float $pdeuterium, int $penergy_used,
            int $penergy_max, int $pmetal_mine_percent, int $pcrystal_mine_percent, int $pdeuterium_synthesizer_percent,
            int $psolar_plant_percent, int $pfusion_reactor_percent,
            int $psolar_satellite_percent, int $pb_building_id, int $pb_building_endtime, int $pb_tech_id,
            int $pb_tech_endtime, int $pb_hangar_start_time, string $pb_hangar_id, int $pb_hangar_plus, int $pdestroyed
        ) {

            $this->planetID = $pID;
            $this->ownerID = $pownerID;
            $this->name = $pname;
            $this->galaxy = $pgala;
            $this->system = $psystem;
            $this->planet = $pplanet;
            $this->last_update = $plast_update;
            $this->planet_type = $pplanet_type;
            $this->image = $pimage;
            $this->diameter = $pdiameter;
            $this->fields_current = $pfields_current;
            $this->fields_max = $pfields_max;
            $this->temp_min = $ptemp_min;
            $this->temp_max = $ptemp_max;
            $this->metal = $pmetal;
            $this->crystal = $pcrystal;
            $this->deuterium = $pdeuterium;
            $this->energy_used = $penergy_used;
            $this->energy_max = $penergy_max;
            $this->metal_mine_percent = $pmetal_mine_percent;
            $this->crystal_mine_percent = $pcrystal_mine_percent;
            $this->deuterium_synthesizer_percent = $pdeuterium_synthesizer_percent;
            $this->solar_plant_percent = $psolar_plant_percent;
            $this->fusion_reactor_percent = $pfusion_reactor_percent;
            $this->solar_satellite_percent = $psolar_satellite_percent;
            $this->b_building_id = $pb_building_id;
            $this->b_building_endtime = $pb_building_endtime;
            $this->b_tech_id = $pb_tech_id;
            $this->b_tech_endtime = $pb_tech_endtime;
            $this->b_hangar_start_time = $pb_hangar_start_time;
            $this->b_hangar_id = $pb_hangar_id;
            $this->b_hangar_plus = $pb_hangar_plus;
            $this->destroyed = $pdestroyed;
        }

        public function printPlanet() : void {

            echo '<pre>';
            print_r($this);
            echo '</pre>';
        }

        /**
         * @return mixed
         */
        public function getMetalMinePercent() : int {

            return $this->metal_mine_percent;
        }

        /**
         * @param mixed $metal_mine_percent
         */
        public function setMetalMinePercent($metal_mine_percent) : void {

            $this->metal_mine_percent = $metal_mine_percent;
        }

        /**
         * @return mixed
         */
        public function getCrystalMinePercent() : int {

            return $this->crystal_mine_percent;
        }

        /**
         * @param mixed $crystal_mine_percent
         */
        public function setCrystalMinePercent($crystal_mine_percent) : void {

            $this->crystal_mine_percent = $crystal_mine_percent;
        }

        /**
         * @return mixed
         */
        public function getDeuteriumSynthesizerPercent() : int {

            return $this->deuterium_synthesizer_percent;
        }

        /**
         * @param mixed $deuterium_synthesizer_percent
         */
        public function setDeuteriumSynthesizerPercent($deuterium_synthesizer_percent) : void {

            $this->deuterium_synthesizer_percent = $deuterium_synthesizer_percent;
        }

        /**
         * @return mixed
         */
        public function getFusionReactorPercent() : int {

            return $this->fusion_reactor_percent;
        }

        /**
         * @param mixed $fusion_reactor_percent
         */
        public function setFusionReactorPercent($fusion_reactor_percent) : void {

            $this->fusion_reactor_percent = $fusion_reactor_percent;
        }

        /**
         * @return mixed
         */
        public function getPlanetID() : int {

            return intval($this->planetID);
        }

        /**
         * @param mixed $planetID
         */
        public function setPlanetID($planetID) : void {

            $this->planetID = $planetID;
        }

        /**
         * @return mixed
         */
        public function getOwnerID() : int {

            return $this->ownerID;
        }

        /**
         * @param mixed $ownerID
         */
        public function setOwnerID($ownerID) : void {

            $this->ownerID = $ownerID;
        }

        /**
         * @return mixed
         */
        public function getName() : string {

            return $this->name;
        }

        /**
         * @param mixed $name
         */
        public function setName($name) : void {

            $this->name = $name;
        }

        /**
         * @return mixed
         */
        public function getGalaxy() : int {

            return $this->galaxy;
        }

        /**
         * @param mixed $galaxy
         */
        public function setGalaxy($galaxy) : void {

            $this->galaxy = $galaxy;
        }

        /**
         * @return mixed
         */
        public function getSystem() : int {

            return $this->system;
        }

        /**
         * @param mixed $system
         */
        public function setSystem($system) : void {

            $this->system = $system;
        }

        /**
         * @return mixed
         */
        public function getPlanet() : int {

            return $this->planet;
        }

        /**
         * @param mixed $planet
         */
        public function setPlanet($planet) : void {

            $this->planet = $planet;
        }

        /**
         * @return mixed
         */
        public function getLastUpdate() : int {

            return $this->last_update;
        }

        /**
         * @param mixed $last_update
         */
        public function setLastUpdate($last_update) : void {

            $this->last_update = $last_update;
        }

        /**
         * @return mixed
         */
        public function getPlanetType() : int {

            return $this->planet_type;
        }

        /**
         * @param mixed $planet_type
         */
        public function setPlanetType($planet_type) : void {

            $this->planet_type = $planet_type;
        }

        /**
         * @return mixed
         */
        public function getImage() : string {

            return $this->image;
        }

        /**
         * @param mixed $image
         */
        public function setImage($image) : void {

            $this->image = $image;
        }

        /**
         * @return mixed
         */
        public function getDiameter() : int {

            return $this->diameter;
        }

        /**
         * @param mixed $diameter
         */
        public function setDiameter($diameter) : void {

            $this->diameter = $diameter;
        }

        /**
         * @return mixed
         */
        public function getFieldsCurrent() : int {

            return $this->fields_current;
        }

        /**
         * @param mixed $fields_current
         */
        public function setFieldsCurrent($fields_current) : void {

            $this->fields_current = $fields_current;
        }

        /**
         * @return mixed
         */
        public function getFieldsMax() : int {

            return $this->fields_max;
        }

        /**
         * @param mixed $fields_max
         */
        public function setFieldsMax($fields_max) : void {

            $this->fields_max = $fields_max;
        }

        /**
         * @return mixed
         */
        public function getTempMin() : int {

            return $this->temp_min;
        }

        /**
         * @param mixed $temp_min
         */
        public function setTempMin($temp_min) {

            $this->temp_min = $temp_min;
        }

        /**
         * @return mixed
         */
        public function getTempMax() : int {

            return $this->temp_max;
        }

        /**
         * @param mixed $temp_max
         */
        public function setTempMax($temp_max) : void {

            $this->temp_max = $temp_max;
        }

        /**
         * @return mixed
         */
        public function getMetal() : float {

            return $this->metal;
        }

        /**
         * @param mixed $metal
         */
        public function setMetal($metal) : void {

            $this->metal = $metal;
        }

        /**
         * @return mixed
         */
        public function getCrystal() : float {

            return $this->crystal;
        }

        /**
         * @param mixed $crystal
         */
        public function setCrystal($crystal) : void {

            $this->crystal = $crystal;
        }

        /**
         * @return mixed
         */
        public function getDeuterium() : float {

            return $this->deuterium;
        }

        /**
         * @param mixed $deuterium
         */
        public function setDeuterium($deuterium) : void {

            $this->deuterium = $deuterium;
        }

        /**
         * @return mixed
         */
        public function getEnergyUsed() : int {

            return $this->energy_used;
        }

        /**
         * @param mixed $energy_used
         */
        public function setEnergyUsed($energy_used) : void {

            $this->energy_used = $energy_used;
        }

        /**
         * @return mixed
         */
        public function getEnergyMax() : int {

            return $this->energy_max;
        }

        /**
         * @param mixed $energy_max
         */
        public function setEnergyMax($energy_max) : void {

            $this->energy_max = $energy_max;
        }

        /**
         * @return mixed
         */
        public function getSolarPlantPercent() : int {

            return $this->solar_plant_percent;
        }

        /**
         * @param mixed $solar_plant_percent
         */
        public function setSolarPlantPercent($solar_plant_percent) : void {

            $this->solar_plant_percent = $solar_plant_percent;
        }

        /**
         * @return mixed
         */
        public function getSolarSatellitePercent() : int {

            return $this->solar_satellite_percent;
        }

        /**
         * @param mixed $solar_satellite_percent
         */
        public function setSolarSatellitePercent($solar_satellite_percent) : void {

            $this->solar_satellite_percent = $solar_satellite_percent;
        }

        /**
         * @return mixed
         */
        public function getBBuildingId() : int {

            return $this->b_building_id;
        }

        /**
         * @param mixed $b_building_id
         */
        public function setBBuildingId($b_building_id) : void {

            $this->b_building_id = $b_building_id;
        }

        /**
         * @return mixed
         */
        public function getBBuildingEndtime() : int {

            return $this->b_building_endtime;
        }

        /**
         * @param mixed $b_building_endtime
         */
        public function setBBuildingEndtime($b_building_endtime) : void {

            $this->b_building_endtime = $b_building_endtime;
        }

        /**
         * @return mixed
         */
        public function getBTechId() : int {

            return $this->b_tech_id;
        }

        /**
         * @param mixed $b_tech_id
         */
        public function setBTechId($b_tech_id) : void {

            $this->b_tech_id = $b_tech_id;
        }

        /**
         * @return mixed
         */
        public function getBTechEndtime() : int {

            return $this->b_tech_endtime;
        }

        /**
         * @param mixed $b_tech_endtime
         */
        public function setBTechEndtime($b_tech_endtime) : void {

            $this->b_tech_endtime = $b_tech_endtime;
        }

        /**
         * @return mixed
         */
        public function getBHangarId() : string {

            return $this->b_hangar_id;
        }

        /**
         * @param mixed $b_hangar_id
         */
        public function setBHangarId($b_hangar_id) : void {

            $this->b_hangar_id = $b_hangar_id;
        }

        /**
         * @return mixed
         */
        public function getBHangarPlus() : int {

            return $this->b_hangar_plus;
        }

        /**
         * @param mixed $b_hangar_plus
         */
        public function setBHangarPlus($b_hangar_plus) : void {

            $this->b_hangar_plus = $b_hangar_plus;
        }

        /**
         * @return mixed
         */
        public function getDestroyed() : int {

            return $this->destroyed;
        }

        /**
         * @param mixed $destroyed
         */
        public function setDestroyed($destroyed) : void {

            $this->destroyed = $destroyed;
        }

    }
