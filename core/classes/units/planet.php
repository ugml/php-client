<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class Unit_Planet {

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

        /**
         * Planet constructor.
         * @param $planetID
         * @param $ownerID
         * @param $name
         * @param $galaxy
         * @param $system
         * @param $planet
         * @param $last_update
         * @param $planet_type
         * @param $image
         * @param $diameter
         * @param $fields_current
         * @param $fields_max
         * @param $temp_min
         * @param $temp_max
         * @param $metal
         * @param $crystal
         * @param $deuterium
         * @param $energy_used
         * @param $energy_max
         * @param $metal_mine_percent
         * @param $crystal_mine_percent
         * @param $deuterium_synthesizer_percent
         * @param $solar_plant_percent
         * @param $fusion_reactor_percent
         * @param $solar_satellite_percent
         * @param $b_building_id
         * @param $b_building_endtime
         * @param $b_tech_id
         * @param $b_hangar_start_time
         * @param $b_tech_endtime
         * @param $b_hangar_id
         * @param $b_hangar_plus
         * @param $destroyed
         */
        public function __construct($planetID, $ownerID, $name, $galaxy, $system, $planet, $last_update, $planet_type,
            $image, $diameter, $fields_current, $fields_max, $temp_min, $temp_max, $metal, $crystal, $deuterium,
            $energy_used, $energy_max, $metal_mine_percent, $crystal_mine_percent, $deuterium_synthesizer_percent,
            $solar_plant_percent, $fusion_reactor_percent, $solar_satellite_percent, $b_building_id,
            $b_building_endtime, $b_tech_id, $b_tech_endtime, $b_hangar_start_time, $b_hangar_id, $b_hangar_plus,
            $destroyed) {
            $this->planetID = $planetID;
            $this->ownerID = $ownerID;
            $this->name = $name;
            $this->galaxy = $galaxy;
            $this->system = $system;
            $this->planet = $planet;
            $this->last_update = $last_update;
            $this->planet_type = $planet_type;
            $this->image = $image;
            $this->diameter = $diameter;
            $this->fields_current = $fields_current;
            $this->fields_max = $fields_max;
            $this->temp_min = $temp_min;
            $this->temp_max = $temp_max;
            $this->metal = $metal;
            $this->crystal = $crystal;
            $this->deuterium = $deuterium;
            $this->energy_used = $energy_used;
            $this->energy_max = $energy_max;
            $this->metal_mine_percent = $metal_mine_percent;
            $this->crystal_mine_percent = $crystal_mine_percent;
            $this->deuterium_synthesizer_percent = $deuterium_synthesizer_percent;
            $this->solar_plant_percent = $solar_plant_percent;
            $this->fusion_reactor_percent = $fusion_reactor_percent;
            $this->solar_satellite_percent = $solar_satellite_percent;
            $this->b_building_id = $b_building_id;
            $this->b_building_endtime = $b_building_endtime;
            $this->b_tech_id = $b_tech_id;
            $this->b_tech_endtime = $b_tech_endtime;
            $this->b_hangar_start_time = $b_hangar_start_time;
            $this->b_hangar_id = $b_hangar_id;
            $this->b_hangar_plus = $b_hangar_plus;
            $this->destroyed = $destroyed;
        }

        public function update() {
            global $data, $database, $db, $units;

            $query = 'UPDATE ' . $database['prefix'] . 'planets SET last_update = :last_update, metal = :metal, crystal = :crystal, deuterium = :deuterium, energy_used = :energy_used, energy_max = :energy_max';

            if ($this->last_update < time()) {

                $time_diff = time() - $this->last_update;

                $lvl_metal = $data->getBuilding()[$units->getUnitID('metal_mine')];
                $lvl_crystal = $data->getBuilding()[$units->getUnitID('crystal_mine')];
                $lvl_deuterium = $data->getBuilding()[$units->getUnitID('deuterium_synthesizer')];

                $prod_energy = array_sum($units->getEnergyProduction(
                    $data->getBuilding()[$units->getUnitID('solar_plant')],
                    $data->getBuilding()[$units->getUnitID('fusion_reactor')],
                    $data->getTech()[$units->getUnitID('energy_tech')],
                    $data->getFleet()[$units->getUnitID('solar_satellite')],
                    $this->temp_max
                )
                );

                $cons_energy = $this->getMetalMinePercent() / 100 * $units->getEnergyConsumption($lvl_metal) +
                    $this->getCrystalMinePercent() / 100 * $units->getEnergyConsumption($lvl_crystal) +
                    $this->getDeuteriumSynthesizerPercent() / 100 * $units->getEnergyConsumption($lvl_deuterium) +
                    $this->getFusionReactorPercent() / 100 * $units->getEnergyConsumption($data->getBuilding()['fusion_reactor']);

                $prod_factor = 1;

                if ($cons_energy > $prod_energy) {
                    $prod_factor = 0.5;
                }

                $storage = array(
                    'metal'     => $units->getStorageCapacity($data->getBuilding()['metal_storage']),
                    'crystal'   => $units->getStorageCapacity($data->getBuilding()['crystal_storage']),
                    'deuterium' => $units->getStorageCapacity($data->getBuilding()['deuterium_storage'])
                );

                // do not produce more then there is storage!
                if ($this->metal < $storage['metal']) {
                    $prod_metal = $prod_factor * $this->getMetalMinePercent() * ($units->getMetalProductionPerHour($lvl_metal) / 3600) * $time_diff;

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
                    $prod_crystal = $prod_factor * $this->getCrystalMinePercent() * ($units
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
                    $prod_deuterium = $prod_factor * $this->getDeuteriumSynthesizerPercent() * ($units
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

                    $methodArr = explode('_', $units->getUnit($this->b_building_id));

                    $method = 'get';

                    foreach ($methodArr as $a => $b) {
                        $method .= ucfirst($b);
                    }
                    $level = call_user_func_array(array($data->getBuilding(), $method), array());

                    // update the building level
                    $stmt = $db->prepare('UPDATE ' . $database['prefix'] . 'buildings SET ' . $units
                            ->getUnit($this->b_building_id) . ' = ' . ($level + 1));

                    $stmt->execute();

                    $query .= ', b_building_id = 0, b_building_endtime = 0';
                }

                // check if research finished
                if ($this->b_tech_id > 0 && $this->b_tech_endtime > 0 && $this->b_tech_endtime <= time()) {

                    $level = $data->getTech()[$units->getUnit($this->b_tech_id)]->getLevel();

                    // update the building level
                    $stmt = $db->prepare('UPDATE ' . $database['prefix'] . 'techs SET ' . $units
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

                            $durationForOneUnit = 3600 * $units
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
                                $methodArr = explode('_', $units->getUnit($unitID));

                                $method = 'get';

                                foreach ($methodArr as $a => $b) {
                                    $method .= ucfirst($b);
                                }
                                $currentShipCount = call_user_func_array(array($data->getFleet(), $method), array());

                                // add the new shipcount to this unit
                                $methodArr = explode('_', $units->getUnit($unitID));

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
                                $stmt = $db->prepare('UPDATE ' . $database['prefix'] . 'fleet SET ' . $units
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

                // update the values of the planet-object
                $this->last_update = $time;
                $this->metal = $prod_metal;
                $this->crystal = $prod_crystal;
                $this->deuterium = $prod_deuterium;
                $this->energy_used = $cons_energy;
                $this->energy_max = $prod_energy;

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
        public function getMetalMinePercent() {
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
        public function getCrystalMinePercent() {
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
        public function getDeuteriumSynthesizerPercent() {
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
        public function getFusionReactorPercent() {
            return $this->fusion_reactor_percent;
        }

        /**
         * @param mixed $fusion_reactor_percent
         */
        public function setFusionReactorPercent($fusion_reactor_percent) : void {
            $this->fusion_reactor_percent = $fusion_reactor_percent;
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
         * @return mixed
         */
        public function getPlanetID() {
            return $this->planetID;
        }

        /**
         * @return mixed
         */
        public function getType() {
            return $this->type;
        }

        /**
         * @return mixed
         */
        public function getOwnerID() {
            return $this->ownerID;
        }

        /**
         * @return mixed
         */
        public function getName() {
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
        public function getGalaxy() {
            return $this->galaxy;
        }

        /**
         * @return mixed
         */
        public function getSystem() {
            return $this->system;
        }

        /**
         * @return mixed
         */
        public function getPlanet() {
            return $this->planet;
        }

        /**
         * @return mixed
         */
        public function getLastUpdate() {
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
        public function getPlanetType() {
            return $this->planet_type;
        }

        /**
         * @return mixed
         */
        public function getImage() {
            return $this->image;
        }

        /**
         * @return mixed
         */
        public function getDiameter() {
            return $this->diameter;
        }

        /**
         * @return mixed
         */
        public function getFieldsCurrent() {
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
        public function getFieldsMax() {
            return $this->fields_max;
        }

        /**
         * @return mixed
         */
        public function getTempMin() {
            return $this->temp_min;
        }

        /**
         * @return mixed
         */
        public function getTempMax() {
            return $this->temp_max;
        }

        /**
         * @return mixed
         */
        public function getMetal() {
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
        public function getCrystal() {
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
        public function getDeuterium() {
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
        public function getEnergyUsed() {
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
        public function getEnergyMax() {
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
        public function getSolarPlantPercent() {
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
        public function getSolarSatellitePercent() {
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
        public function getBBuildingId() {
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
        public function getBBuildingEndtime() {
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
        public function getBTechId() {
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
        public function getBHangarStartTime() {
            return $this->b_hangar_start_time;
        }

        /**
         * @param mixed $b_hangar_start_time
         */
        public function setBHangarStartTime($b_hangar_start_time) : void {
            $this->b_hangar_start_time = $b_hangar_start_time;
        }

        /**
         * @return mixed
         */
        public function getBTechEndtime() {
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
        public function getBHangarId() {
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
        public function getBHangarPlus() {
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
        public function getDestroyed() {
            return $this->destroyed;
        }

        /**
         * @param mixed $destroyed
         */
        public function setDestroyed($destroyed) : void {
            $this->destroyed = $destroyed;
        }

        public function printPlanet() : void {
            echo '<pre>';
            print_r($this);
            echo '</pre>';
        }

    }