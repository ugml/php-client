<?php

    declare(strict_types = 1);


    defined('INSIDE') OR exit('No direct script access allowed');

    /**
     * This class maps the 'planet'-table to an php object.
     */
    class D_Planet {

        /** @var int The ID of the planet */
        private $planetID;

        /** @var int The playerID of the owner */
        private $ownerID;

        /** @var string The name of the planet */
        private $name;

        /** @var int The galaxy-coordinate of the planet */
        private $galaxy;

        /** @var int The system-coordinate of the planet */
        private $system;

        /** @var int The planet-coordinate of the planet */
        private $planet;

        /** @var int The time, the planet was updated the last time */
        private $last_update;

        /** @var int The type of the planet (0 - moon | 1 - planet) */
        private $planet_type;

        /** @var string The image of the planet */
        private $image;

        /** @var int The diameter of the planet */
        private $diameter;

        /** @var int The number of currently used fields on the planet */
        private $fields_current;

        /** @var int The number of maximum usable fields on the planet */
        private $fields_max;

        /** @var int The minimal temperature on the planet */
        private $temp_min;

        /** @var int The maximal temperature on the planet */
        private $temp_max;

        /** @var float The currently stored amount of metal on the planet */
        private $metal;

        /** @var float The currently stored amount of crystal on the planet */
        private $crystal;

        /** @var float The currently stored amount of deuterium on the planet */
        private $deuterium;

        /** @var int The currently used amount of energy on the planet */
        private $energy_used;

        /** @var int The maximal usable amount of energy on the planet */
        private $energy_max;

        /** @var int The maximal usable amount of energy on the planet */
        private $metal_mine_percent;

        /** @var int The maximal usable amount of energy on the planet */
        private $crystal_mine_percent;

        /** @var int The maximal usable amount of energy on the planet */
        private $deuterium_synthesizer_percent;

        /** @var int The percentage, at which the solar plant operates */
        private $solar_plant_percent;

        /** @var int The percentage, at which the fusion reactor operates */
        private $fusion_reactor_percent;

        /** @var int The percentage, at which the solar satellites operate */
        private $solar_satellite_percent;

        /** @var int The ID of the building, which is currently being built */
        private $b_building_id;

        /** @var int The the time, at which the currently building building will be finished */
        private $b_building_endtime;

        /** @var int The ID of the technology, which is currently being researched */
        private $b_tech_id;

        /** @var int The the time, at which the currently researching technology will be finished */
        private $b_tech_endtime;

        /** @var int The time, at which the current build-order has started */
        private $b_hangar_start_time;

        /** @var string The ships, which are currently being built */
        private $b_hangar_id;

        /** @var bool Signals, if the hangar is currently being upgraded */
        private $b_hangar_plus;

        /** @var bool Signals, if the planet was destroyed */
        private $destroyed;

        /**
         * D_Planet constructor.
         * @param int    $pID
         * @param int    $pownerID
         * @param string $pname
         * @param int    $pgala
         * @param int    $psystem
         * @param int    $pplanet
         * @param int    $plast_update
         * @param int    $pplanet_type
         * @param string $pimage
         * @param int    $pdiameter
         * @param int    $pfields_current
         * @param int    $pfields_max
         * @param int    $ptemp_min
         * @param int    $ptemp_max
         * @param float  $pmetal
         * @param float  $pcrystal
         * @param float  $pdeuterium
         * @param int    $penergy_used
         * @param int    $penergy_max
         * @param int    $pmetal_mine_percent
         * @param int    $pcrystal_mine_percent
         * @param int    $pdeuterium_synthesizer_percent
         * @param int    $psolar_plant_percent
         * @param int    $pfusion_reactor_percent
         * @param int    $psolar_satellite_percent
         * @param int    $pb_building_id
         * @param int    $pb_building_endtime
         * @param int    $pb_tech_id
         * @param int    $pb_tech_endtime
         * @param int    $pb_hangar_start_time
         * @param string $pb_hangar_id
         * @param bool    $pb_hangar_plus
         * @param bool    $pdestroyed
         */
        public function __construct(
            int $pID, int $pownerID, string $pname, int $pgala, int $psystem, int $pplanet, int $plast_update,
            int $pplanet_type, string $pimage,
            int $pdiameter, int $pfields_current, int $pfields_max, int $ptemp_min, int $ptemp_max, float $pmetal,
            float $pcrystal, float $pdeuterium, int $penergy_used,
            int $penergy_max, int $pmetal_mine_percent, int $pcrystal_mine_percent, int $pdeuterium_synthesizer_percent,
            int $psolar_plant_percent, int $pfusion_reactor_percent,
            int $psolar_satellite_percent, int $pb_building_id, int $pb_building_endtime, int $pb_tech_id,
            int $pb_tech_endtime, int $pb_hangar_start_time, string $pb_hangar_id, bool $pb_hangar_plus, bool $pdestroyed
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

        /**
         * @codeCoverageIgnore
         */
        public function print() : void {
            echo '<pre>';
            print_r($this);
            echo '</pre>';
        }

        /**
         * @return int
         */
        public function getMetalMinePercent() : int {

            return $this->metal_mine_percent;
        }

        /**
         * @param int $metal_mine_percent
         */
        public function setMetalMinePercent(int $metal_mine_percent) : void {

            if($metal_mine_percent >= 0 && $metal_mine_percent <= 100 && $metal_mine_percent % 10 == 0) {
                $this->metal_mine_percent = $metal_mine_percent;
            }

        }

        /**
         * @return int
         */
        public function getCrystalMinePercent() : int {

            return $this->crystal_mine_percent;
        }

        /**
         * @param int $crystal_mine_percent
         */
        public function setCrystalMinePercent(int $crystal_mine_percent) : void {

            if($crystal_mine_percent >= 0 && $crystal_mine_percent <= 100 && $crystal_mine_percent % 10 == 0) {
                $this->crystal_mine_percent = $crystal_mine_percent;
            }
        }

        /**
         * @return int
         */
        public function getDeuteriumSynthesizerPercent() : int {

            return $this->deuterium_synthesizer_percent;
        }

        /**
         * @param int $deuterium_synthesizer_percent
         */
        public function setDeuteriumSynthesizerPercent(int $deuterium_synthesizer_percent) : void {

            if($deuterium_synthesizer_percent >= 0 && $deuterium_synthesizer_percent <= 100 && $deuterium_synthesizer_percent % 10 == 0) {
                $this->deuterium_synthesizer_percent = $deuterium_synthesizer_percent;
            }
        }

        /**
         * @return int
         */
        public function getFusionReactorPercent() : int {

            return $this->fusion_reactor_percent;
        }

        /**
         * @param int $fusion_reactor_percent
         */
        public function setFusionReactorPercent(int $fusion_reactor_percent) : void {

            if($fusion_reactor_percent >= 0 && $fusion_reactor_percent <= 100 && $fusion_reactor_percent % 10 == 0) {
                $this->fusion_reactor_percent = $fusion_reactor_percent;
            }
        }

        /**
         * @return int
         */
        public function getSolarPlantPercent() : int {

            return $this->solar_plant_percent;
        }

        /**
         * @param int $solar_plant_percent
         */
        public function setSolarPlantPercent(int $solar_plant_percent) : void {

            if($solar_plant_percent >= 0 && $solar_plant_percent <= 100 && $solar_plant_percent % 10 == 0) {
                $this->solar_plant_percent = $solar_plant_percent;
            }
        }

        /**
         * @return int
         */
        public function getSolarSatellitePercent() : int {

            return $this->solar_satellite_percent;
        }

        /**
         * @param int $solar_satellite_percent
         */
        public function setSolarSatellitePercent(int $solar_satellite_percent) : void {

            if($solar_satellite_percent >= 0 && $solar_satellite_percent <= 100 && $solar_satellite_percent % 10 == 0) {
                $this->solar_satellite_percent = $solar_satellite_percent;
            }
        }

        /**
         * @return int
         */
        public function getPlanetID() : int {

            return intval($this->planetID);
        }

        /**
         * @param int $planetID
         */
        public function setPlanetID(int $planetID) : void {

            if($planetID > 0) $this->planetID = $planetID;
        }

        /**
         * @return int
         */
        public function getOwnerID() : int {

            return $this->ownerID;
        }

        /**
         * @param int $ownerID
         */
        public function setOwnerID(int $ownerID) : void {

            if($ownerID > 0) $this->ownerID = $ownerID;
        }

        /**
         * @return string
         */
        public function getName() : string {

            return $this->name;
        }

        /**
         * @param string $name
         */
        public function setName(string $name) : void {

            if(strlen($name) > 0) $this->name = $name;
        }

        /**
         * @return int
         */
        public function getGalaxy() : int {

            return $this->galaxy;
        }

        /**
         * @param int $galaxy
         */
        public function setGalaxy(int $galaxy) : void {
            global $config;

            if($config['max_galaxy'] >= $galaxy && $galaxy > 0) {
                $this->galaxy = $galaxy;
            }
        }

        /**
         * @return int
         */
        public function getSystem() : int {

            return $this->system;
        }

        /**
         * @param int $system
         */
        public function setSystem(int $system) : void {
            global $config;

            if($config['max_system'] >= $system && $system > 0) {
                $this->system = $system;
            }
        }

        /**
         * @return int
         */
        public function getPlanet() : int {

            return $this->planet;
        }

        /**
         * @param int $planet
         */
        public function setPlanet(int $planet) : void {
            global $config;

            if($config['max_planet'] >= $planet && $planet > 0) {
                $this->planet = $planet;
            }
        }

        /**
         * @return int
         */
        public function getLastUpdate() : int {

            return $this->last_update;
        }

        /**
         * @param int $last_update
         */
        public function setLastUpdate(int $last_update) : void {

            if($last_update > time() - 15724800) $this->last_update = $last_update;
        }

        /**
         * @return int
         */
        public function getPlanetType() : int {

            return $this->planet_type;
        }

        /**
         * @param int $planet_type
         */
        public function setPlanetType(int $planet_type) : void {

            if($planet_type == 0 || $planet_type == 1) {
                $this->planet_type = $planet_type;
            }
        }

        /**
         * @return string
         */
        public function getImage() : string {

            return $this->image;
        }

        /**
         * @param string $image
         */
        public function setImage(string $image) : void {

            if(strlen($image) > 0) $this->image = $image;
        }

        /**
         * @return int
         */
        public function getDiameter() : int {

            return $this->diameter;
        }

        /**
         * @param int $diameter
         */
        public function setDiameter(int $diameter) : void {

            if($diameter > 0) $this->diameter = $diameter;
        }

        /**
         * @return int
         */
        public function getFieldsCurrent() : int {

            return $this->fields_current;
        }

        /**
         * @param int $fields_current
         */
        public function setFieldsCurrent(int $fields_current) : void {

            if($fields_current > 0 && $fields_current <= $this->fields_max) {
                $this->fields_current = $fields_current;
            }
        }

        /**
         * @return int
         */
        public function getFieldsMax() : int {

            return $this->fields_max;
        }

        /**
         * @param int $fields_max
         */
        public function setFieldsMax(int $fields_max) : void {

            if($fields_max > 0) {
                $this->fields_max = $fields_max;
            }
        }

        /**
         * @return int
         */
        public function getTempMin() : int {

            return $this->temp_min;
        }

        /**
         * @param int $temp_min
         */
        public function setTempMin(int $temp_min) {

            $this->temp_min = $temp_min;
        }

        /**
         * @return int
         */
        public function getTempMax() : int {

            return $this->temp_max;
        }

        /**
         * @param int $temp_max
         */
        public function setTempMax(int $temp_max) : void {

            $this->temp_max = $temp_max;
        }

        /**
         * @return float
         */
        public function getMetal() : float {

            return $this->metal;
        }

        /**
         * @param float $metal
         */
        public function setMetal(float $metal) : void {

            if($metal > 0) $this->metal = $metal;
        }

        /**
         * @return float
         */
        public function getCrystal() : float {

            return $this->crystal;
        }

        /**
         * @param float $crystal
         */
        public function setCrystal(float $crystal) : void {

            if($crystal > 0) $this->crystal = $crystal;
        }

        /**
         * @return float
         */
        public function getDeuterium() : float {

            return $this->deuterium;
        }

        /**
         * @param float $deuterium
         */
        public function setDeuterium(float $deuterium) : void {

            if($deuterium > 0) $this->deuterium = $deuterium;
        }

        /**
         * @return int
         */
        public function getEnergyUsed() : int {

            return $this->energy_used;
        }

        /**
         * @param int $energy_used
         */
        public function setEnergyUsed(int $energy_used) : void {

            if($energy_used > 0) $this->energy_used = $energy_used;
        }

        /**
         * @return int
         */
        public function getEnergyMax() : int {

            return $this->energy_max;
        }

        /**
         * @param int $energy_max
         */
        public function setEnergyMax(int $energy_max) : void {

            if($energy_max > 0) $this->energy_max = $energy_max;
        }

        /**
         * @return int
         */
        public function getBBuildingId() : int {

            return $this->b_building_id;
        }

        /**
         * @param int $b_building_id
         */
        public function setBBuildingId(int $b_building_id) : void {

            if($b_building_id >= 0) $this->b_building_id = $b_building_id;
        }

        /**
         * @return int
         */
        public function getBBuildingEndtime() : int {

            return $this->b_building_endtime;
        }

        /**
         * @param int $b_building_endtime
         */
        public function setBBuildingEndtime(int $b_building_endtime) : void {

            if($b_building_endtime >= 0) $this->b_building_endtime = $b_building_endtime;
        }

        /**
         * @return int
         */
        public function getBTechId() : int {

            return $this->b_tech_id;
        }

        /**
         * @param int $b_tech_id
         */
        public function setBTechId(int $b_tech_id) : void {

            if($b_tech_id >= 0) $this->b_tech_id = $b_tech_id;
        }

        /**
         * @return int
         */
        public function getBTechEndtime() : int {

            return $this->b_tech_endtime;
        }

        /**
         * @param int $b_tech_endtime
         */
        public function setBTechEndtime(int $b_tech_endtime) : void {

            if($b_tech_endtime > 0) $this->b_tech_endtime = $b_tech_endtime;
        }

        /**
         * @return string
         */
        public function getBHangarId() : string {

            return $this->b_hangar_id;
        }

        /**
         * @param string $b_hangar_id
         */
        public function setBHangarId(string $b_hangar_id) : void {

            $this->b_hangar_id = $b_hangar_id;
        }

        /**
         * @return bool
         */
        public function getBHangarPlus() : bool {

            return $this->b_hangar_plus;
        }

        /**
         * @param bool $b_hangar_plus
         */
        public function setBHangarPlus(bool $b_hangar_plus) : void {

            if($b_hangar_plus > 0) $this->b_hangar_plus = $b_hangar_plus;
        }

        /**
         * @return bool
         */
        public function getDestroyed() : bool {

            return $this->destroyed;
        }

        /**
         * @param bool $destroyed
         */
        public function setDestroyed(bool $destroyed) : void {

                $this->destroyed = $destroyed;

        }

    }
