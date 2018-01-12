<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class Planet {

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
         * creates a new planet at the given coordinate
         *
         * if no coordinates are given, they are chosen
         * randomly
         *
         * @param      $type planettype {1 = planet, 2 = moon}
         * @param null $g    galaxy-coordinate
         * @param null $s    system-coordinate
         * @param null $p    planet-coordinate
         */
        public function createPlanet($type, $g = null, $s = null, $p = null) : void {

            global $config, $database;

            //--- check the passed values ------------------------------------------------------------------------------
            //check if only one or two are null
            if (empty($g) + empty($s) + empty($p) < 3) {
                die('one argument was null');
            } else {
                if (empty($g) + empty($s) + empty($p) == 3) {
                    //create random coordinates
                    $this->galaxy = rand(1, $config['max_galaxy']);
                    $this->system = rand(1, $config['max_system']);
                    $this->planet = rand(1, $config['max_planet']);
                } else {
                    if ($g > 1 && $g <= $config['max_galaxy']) {
                        $this->galaxy = $g;
                    } else {
                        die('galaxy out of range');
                    }

                    if ($s > 1 && $s <= $config['max_system']) {
                        $this->system = $p;
                    } else {
                        die('system out of range');
                    }

                    if ($p > 1 && $p <= $config['max_planet']) {
                        $this->planet = $p;
                    } else {
                        die('planet out of range');
                    }
                }
            }
            //----------------------------------------------------------------------------------------------------------

            //---------- temp/diameter/fields --------------------------------------------------------------------------

            $this->temp_min = 0;
            $this->temp_max = 0;
            $this->diameter = 0;

            //source: http://ogame.wikia.com/wiki/Temperature
            //        http://wiki.ogame.org/index.php/Tutorial:Colonisation

            switch (true) {
                case $p <= 5:
                    $this->temp_min = rand(40, 130);
                    $this->temp_max = rand(150, 240);
                    $this->diameter = rand(9747, 14595);
                    break;
                case $p <= 10:
                    $this->temp_min = rand(-10, 20);
                    $this->temp_max = rand(40, 70);
                    $this->diameter = rand(11875, 15716);
                    break;
                case $p <= 15:
                    $this->temp_min = rand(-150, -75);
                    $this->temp_max = rand(-55, 20);
                    $this->diameter = rand(8063, 14283);
                    break;
            }

            $this->field_max = round(($this->diameter / 1000) * ($this->diameter / 1000));

            //----------------------------------------------------------------------------------------------------------


            $db = connectToDB();

            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $this->planetID = rand(0, 100000);

            //check if ID is already taken
            while ($db->query('SELECT ownerID FROM ' . $database['prefix'] . 'planets WHERE planetID=' . $this->planetID)
                    ->rowCount() > 0) {
                $this->planetID = rand(0, 100000);
            }

            $stmt = $db->prepare('INSERT INTO ' . $database['prefix'] . 'planets (planetID, ownerID, name, galaxy, system, planet, last_update, planet_type, image, diameter, field_max, temp_min, temp_max) VALUES ' .
                '(:planetID, :ownerID, :name, :galaxy, :system, :planet, :last_update, :planet_type, :image, :diameter, :field_max, :temp_min, :temp_max);');

            $zero = 0; //helper for binding


            $stmt->bindParam(':planetID', $this->planetID);
            $stmt->bindParam(':ownerID', $this->ownerID);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':galaxy', $this->galaxy);
            $stmt->bindParam(':system', $this->system);
            $stmt->bindParam(':planet', $this->planet);
            $stmt->bindParam(':last_update', $zero);
            $stmt->bindParam(':planet_type', $type);
            $stmt->bindParam(':image', $zero);
            $stmt->bindParam(':diameter', $this->diameter);
            $stmt->bindParam(':field_max', $this->field_max);
            $stmt->bindParam(':temp_min', $this->temp_min);
            $stmt->bindParam(':temp_max', $this->temp_min);

            $stmt->execute();

        }

        /**
         * updates the produced resources of a planet
         * and checks, if a building is finished
         */
        public function updatePlanet() : void {

            global $data, $database, $db;

            $query = 'UPDATE ' . $database['prefix'] . 'planets SET last_update = :last_update, metal = :metal, crystal = :crystal, deuterium = :deuterium, energy_used = :energy_used, energy_max = :energy_max';

            if ($this->last_update < time()) {

                $time_diff = time() - $this->last_update;

                $lvl_metal = $data->getBuilding()->getMetalMine();
                $lvl_crystal = $data->getBuilding()->getCrystalMine();
                $lvl_deuterium = $data->getBuilding()->getDeuteriumSynthesizer();

                $prod_energy = array_sum($data->getUnits()->getEnergyProduction($data->getBuilding()->getSolarPlant(),
                    $data->getBuilding()->getFusionReactor(), $data->getTech()->getEnergyTech(),
                    $data->getFleet()->getSolarSatellite(), $this->temp_max));

                $cons_energy = $this->getMetalMinePercent() / 100 * $data->getUnits()
                        ->getEnergyConsumption($data->getBuilding()->getMetalMine()) +
                    $this->getCrystalMinePercent() / 100 * $data->getUnits()->getEnergyConsumption($data->getBuilding()
                        ->getCrystalMine()) +
                    $this->getDeuteriumSynthesizerPercent() / 100 * $data->getUnits()
                        ->getEnergyConsumption($data->getBuilding()->getDeuteriumSynthesizer()) +
                    $this->getFusionReactorPercent() / 100 * $data->getUnits()
                        ->getEnergyConsumption($data->getBuilding()->getFusionReactor());

                $prod_factor = 1;

                if ($cons_energy > $prod_energy) {
                    $prod_factor = 0.5;
                }

                $storage = array(
                    'metal'     => $data->getUnits()->getStorageCapacity($data->getBuilding()->getMetalStorage()),
                    'crystal'   => $data->getUnits()->getStorageCapacity($data->getBuilding()->getCrystalStorage()),
                    'deuterium' => $data->getUnits()->getStorageCapacity($data->getBuilding()->getDeuteriumStorage())
                );

                // do not produce more then there is storage!
                if ($this->metal < $storage['metal']) {
                    $prod_metal = $prod_factor * $this->getMetalMinePercent() * ($data->getUnits()
                                ->getMetalProductionPerHour($lvl_metal) / 3600) * $time_diff;

                    if ($this->metal + $prod_metal > $storage['metal']) {
                        $prod_metal = $this->metal + ($storage['metal'] - $this->metal);
                    } else {
                        $prod_metal += $this->metal;
                    }
                } else {
                    $prod_metal = $this->metal;
                }

                // do not produce more then there is storage!
                if ($this->crystal < $storage['crystal']) {
                    $prod_crystal = $prod_factor * $this->getCrystalMinePercent() * ($data->getUnits()
                                ->getCrystalProductionPerHour($lvl_crystal) / 3600) * $time_diff;
                    if ($this->crystal + $prod_crystal > $storage['crystal']) {
                        $prod_crystal = $this->crystal + ($storage['crystal'] - $this->crystal);
                    } else {
                        $prod_crystal += $this->crystal;
                    }
                } else {
                    $prod_crystal = $this->crystal;
                }

                // do not produce more then there is storage!
                if ($this->deuterium < $storage['deuterium']) {
                    $prod_deuterium = $prod_factor * $this->getDeuteriumSynthesizerPercent() * ($data->getUnits()
                                ->getDeuteriumProductionPerHour($lvl_deuterium) / 3600) * $time_diff;
                    if ($this->deuterium + $prod_deuterium > $storage['deuterium']) {
                        $prod_crystal = $this->deuterium + ($storage['deuterium'] - $this->deuterium);
                    } else {
                        $prod_deuterium += $this->deuterium;
                    }
                } else {
                    $prod_deuterium = $this->deuterium;
                }


                $time = time();

                // check if building finished
                if ($this->b_building_id > 0 && $this->b_building_endtime > 0 && $this->b_building_endtime <= time()) {

                    $methodArr = explode('_', $data->getUnits()->getUnit($this->b_building_id));

                    $method = 'get';

                    foreach ($methodArr as $a => $b) {
                        $method .= ucfirst($b);
                    }
                    $level = call_user_func_array(array($data->getBuilding(), $method), array());

                    // update the building level
                    $stmt = $db->prepare('UPDATE ' . $database['prefix'] . 'buildings SET ' . $data->getUnits()
                            ->getUnit($this->b_building_id) . ' = ' . ($level + 1));

                    $stmt->execute();

                    $query .= ', b_building_id = 0, b_building_endtime = 0';
                }

                // check if research finished
                if ($this->b_tech_id > 0 && $this->b_tech_endtime > 0 && $this->b_tech_endtime <= time()) {

                    $methodArr = explode('_', $data->getUnits()->getUnit($this->b_tech_id));

                    $method = 'get';

                    foreach ($methodArr as $a => $b) {
                        $method .= ucfirst($b);
                    }

                    $level = call_user_func_array(array($data->getTech(), $method), array());

                    // update the building level
                    $stmt = $db->prepare('UPDATE ' . $database['prefix'] . 'techs SET ' . $data->getUnits()
                            ->getUnit($this->b_tech_id) . ' = ' . ($level + 1));

                    $stmt->execute();

                    $query .= ', b_tech_id = 0, b_tech_endtime = 0';
                }

                $someShipsFinished = false;


                // check if hangar finished
                if ($this->b_hangar_id != null && $this->b_hangar_id != "" && $this->b_hangar_id != 0) {

                    $shipQueueRows = explode(";", $this->b_hangar_id);

                    $timePassedSinceStart = time() - $this->b_hangar_start_time;
                    $totalBuildTimePassed = 0;

                    $i = 0;

                    $shipsLeftArray = [];

                    foreach ($shipQueueRows as $k => $v) {
                        $exp = explode(",", $v);

                        $unitID = intval($exp[0]);
                        $unitCnt = intval($exp[1]);

                        if ($unitID > 0 && $unitCnt > 0) {

                            $durationForOneUnit = 3600 * $data->getUnits()
                                    ->getBuildTime($unitID, 0, $data->getBuilding()->getRoboticFactory(),
                                        $data->getBuilding()->getShipyard(), $data->getBuilding()->getNaniteFactory());

                            $shipFinishedCnt = floor($timePassedSinceStart / $durationForOneUnit);

                            // at least one ship was finished
                            if ($shipFinishedCnt > 0) {

                                if ($shipFinishedCnt > $unitCnt) {
                                    $shipFinishedCnt = $unitCnt;
                                    $timePassedSinceStart -= $durationForOneUnit * $shipFinishedCnt;

                                    $totalBuildTimePassed += $durationForOneUnit * $shipFinishedCnt;

                                    // delete row in buildqueue
                                    unset($shipQueueRows[$i]);

                                } else {
                                    $timePassedSinceStart -= $durationForOneUnit * $shipFinishedCnt;

                                    $totalBuildTimePassed += $durationForOneUnit * $shipFinishedCnt;

                                    // update row in buildqueue
                                    $shipsLeftArray[$i] = array($unitID => ($unitCnt - $shipFinishedCnt));
                                    $i++;
                                }

                                // get the current shipcount of this unit
                                $methodArr = explode('_', $data->getUnits()->getUnit($unitID));

                                $method = 'get';

                                foreach ($methodArr as $a => $b) {
                                    $method .= ucfirst($b);
                                }
                                $currentShipCount = call_user_func_array(array($data->getFleet(), $method), array());

                                // add the new shipcount to this unit
                                $methodArr = explode('_', $data->getUnits()->getUnit($unitID));

                                $method = 'set';

                                foreach ($methodArr as $a => $b) {
                                    $method .= ucfirst($b);
                                }
                                call_user_func_array(array($data->getFleet(),
                                                           $method
                                ), array($currentShipCount + $shipFinishedCnt));


                                // TODO: BUG! only first row of queue will be written to DB!
                                print_r($shipsLeftArray);

                                $shipQueue = "";
                                for ($i = 0; $i < sizeof($shipsLeftArray); $i++) {
                                    if (intval($shipsLeftArray[$i][key($shipsLeftArray[$i])]) > 0) {
                                        $shipQueue .= key($shipsLeftArray[$i]) . "," . $shipsLeftArray[$i][key($shipsLeftArray[$i])] . ";\n";
                                    }
                                }

                                $this->b_hangar_id = $shipQueue;

                                // update the building level
                                $stmt = $db->prepare('UPDATE ' . $database['prefix'] . 'fleet SET ' . $data->getUnits()
                                        ->getUnit($unitID) . ' = ' . ($currentShipCount + $shipFinishedCnt) . ' WHERE planetId = ' . $this->planetID);

                                $stmt->execute();

                            }
                        }

                    }

                    if (strlen($this->b_hangar_id) == 0) {
                        $this->b_hangar_start_time = 0;
                    } else {
                        $this->b_hangar_start_time = $this->b_hangar_start_time + $totalBuildTimePassed;
                    }

                    $query .= ', b_hangar_start_time = :b_hangar_start_time, b_hangar_id = :b_hangar_id ';
                    $someShipsFinished = true;

                }

                $query .= ' WHERE planetID = :planetID;';

                $stmt = $db->prepare($query);

                $stmt->bindParam(':last_update', $time);
                $stmt->bindParam(':metal', $prod_metal);

                if ($someShipsFinished) {
                    $stmt->bindParam(':b_hangar_start_time', $this->b_hangar_start_time);
                    $stmt->bindParam(':b_hangar_id', $this->b_hangar_id);
                }

                $stmt->bindParam(':crystal', $prod_crystal);
                $stmt->bindParam(':deuterium', $prod_deuterium);
                $stmt->bindParam(':energy_used', $cons_energy);
                $stmt->bindParam(':energy_max', $prod_energy);
                $stmt->bindParam(':planetID', $this->planetID);

                $stmt->execute();
            }
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
