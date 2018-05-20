<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class U_Planet {

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
         * U_Planet constructor.
         * @param int    $planetID
         * @param int    $ownerID
         * @param string $name
         * @param int    $galaxy
         * @param int    $system
         * @param int    $planet
         * @param int    $last_update
         * @param int    $planet_type
         * @param string $image
         * @param int    $diameter
         * @param int    $fields_current
         * @param int    $fields_max
         * @param int    $temp_min
         * @param int    $temp_max
         * @param float  $metal
         * @param float  $crystal
         * @param float  $deuterium
         * @param int    $energy_used
         * @param int    $energy_max
         * @param int    $metal_mine_percent
         * @param int    $crystal_mine_percent
         * @param int    $deuterium_synthesizer_percent
         * @param int    $solar_plant_percent
         * @param int    $fusion_reactor_percent
         * @param int    $solar_satellite_percent
         * @param int    $b_building_id
         * @param int    $b_building_endtime
         * @param int    $b_tech_id
         * @param int    $b_tech_endtime
         * @param int    $b_hangar_start_time
         * @param string $b_hangar_id
         * @param bool   $b_hangar_plus
         * @param bool   $destroyed
         */
        public function __construct(int $planetID, int $ownerID, string $name, int $galaxy, int $system, int $planet,
            int $last_update, int $planet_type,
            string $image, int $diameter, int $fields_current, int $fields_max, int $temp_min, int $temp_max,
            float $metal, float $crystal, float $deuterium,
            int $energy_used, int $energy_max, int $metal_mine_percent, int $crystal_mine_percent,
            int $deuterium_synthesizer_percent,
            int $solar_plant_percent, int $fusion_reactor_percent, int $solar_satellite_percent, int $b_building_id,
            int $b_building_endtime, int $b_tech_id, int $b_tech_endtime, int $b_hangar_start_time, string $b_hangar_id,
            bool $b_hangar_plus,
            bool $destroyed) {
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

        public function update(D_Building $buildings, D_Tech $technologies, D_Fleet $fleet) {

            $dbConnection = new Database();

            $query = 'UPDATE ' . Config::$dbConfig['prefix'] . 'planets SET last_update = :last_update, metal = :metal, crystal = :crystal, deuterium = :deuterium, energy_used = :energy_used, energy_max = :energy_max';

            $time = time();

            if ($this->last_update < $time) {

                $time_diff = $time - $this->last_update;

                $lvl_metal = $buildings->getMetalMine();
                $lvl_crystal = $buildings->getCrystalMine();
                $lvl_deuterium = $buildings->getDeuteriumSynthesizer();
                $lvl_fusion = $buildings->getFusionReactor();

                $prod_energy = $this->getTotalEnergyProduction(Config::$gameConfig['base_income_energy'],
                    $buildings->getSolarPlant(), $buildings->getFusionReactor(), $technologies->getEnergyTech(),
                    $fleet->getSolarSatellite());
                $cons_energy = $this->getTotalEnergyConsumption($lvl_metal, $lvl_crystal, $lvl_deuterium, $lvl_fusion);

                // default factor
                $prod_factor = 1;

                // if there is more energy-usage than production
                if ($cons_energy > $prod_energy) {
                    $prod_factor = 0.5;
                }

                $storage = array(
                    'metal'     => D_Units::getStorageCapacity($buildings->getMetalStorage()),
                    'crystal'   => D_Units::getStorageCapacity($buildings->getCrystalStorage()),
                    'deuterium' => D_Units::getStorageCapacity($buildings->getDeuteriumStorage())
                );

                //($metalLvl, $storageCapacity, $prodFactor, $timeDiff, $baseIncome) {

                $prod_metal = $this->calculateMetalProduction($lvl_metal, $storage['metal'], $prod_factor, $time_diff,
                    Config::$gameConfig['base_income_metal']);
                $prod_crystal = $this->calculateCrystalProduction($lvl_crystal, $storage['crystal'], $prod_factor,
                    $time_diff, Config::$gameConfig['base_income_crystal']);
                $prod_deuterium = $this->calculateDeuteriumProduction($lvl_deuterium, $storage['deuterium'],
                    $prod_factor, $time_diff, Config::$gameConfig['base_income_deuterium']);

                // check if building finished
                if ($this->b_building_id > 0 && $this->b_building_endtime > 0 && $this->b_building_endtime <= $time) {

                    $level = Loader::getBuildingList()[$this->b_building_id]->getLevel();

                    //                    $methodArr = explode('_', D_Units::getUnit());
                    //
                    //                    $method = 'get';
                    //
                    //                    foreach ($methodArr as $a => $b) {
                    //                        $method .= ucfirst($b);
                    //                    }
                    //                    $level = call_user_func_array(array($data->getBuildingList(), $method), array());

                    // update the building level
                    $stmt = $dbConnection->prepare('UPDATE ' . Config::$dbConfig['prefix'] . 'buildings SET ' . D_Units::getUnitName($this->b_building_id) . ' = ' . ($level + 1));

                    $stmt->execute();

                    $query .= ', b_building_id = 0, b_building_endtime = 0';
                }

                // check if research finished
                if ($this->b_tech_id > 0 && $this->b_tech_endtime > 0 && $this->b_tech_endtime <= $time) {

                    $level = Loader::getTechList()[$this->b_tech_id]->getLevel();

                    // update the building level
                    $stmt = $dbConnection->prepare('UPDATE ' . Config::$dbConfig['prefix'] . 'techs SET ' . D_Units::getUnitName($this->b_tech_id) . ' = ' . ($level + 1));

                    $stmt->execute();

                    $query .= ', b_tech_id = 0, b_tech_endtime = 0';
                }

                $someShipsFinished = false;

                // check if hangar finished
                if ($this->b_hangar_id != null && $this->b_hangar_id != "" && $this->b_hangar_id != 0) {

                    $shipQueueRows = explode(";", $this->b_hangar_id);
                    $totalBuildTimePassed = 0;

                    $i = 0;

                    $shipsLeftArray = [];

                    $skip = false;

                    $queuePos = 1;

                    foreach ($shipQueueRows as $key => $value) {

                        $timePassedSinceStart = $time - $this->b_hangar_start_time;

                        $exp = explode(",", $value);

                        $unitID = intval($exp[0]);
                        $unitCnt = intval($exp[1]);

                        if ($unitID > 0 && $unitCnt > 0) {

                            $durationForOneUnit = 3600 * D_Units::getBuildTime(Loader::getFleetList()[$unitID],
                                    Loader::getBuildingList()[6]->getLevel(), Loader::getBuildingList()[8]->getLevel(),
                                    Loader::getBuildingList()[7]->getLevel());

                            $shipFinishedCnt = floor($timePassedSinceStart / $durationForOneUnit);

                            // at least one ship was finished
                            if ($shipFinishedCnt > 0 && !$skip) {

                                $someShipsFinished = true;

                                if ($shipFinishedCnt > $unitCnt) {

                                    $shipFinishedCnt = $unitCnt;

                                    $totalBuildTimePassed += $durationForOneUnit * $shipFinishedCnt;
                                    // delete row in buildqueue
                                    unset($shipQueueRows[$i]);
                                    $i++;

                                    // set the new start-time
                                    $this->b_hangar_start_time += round($totalBuildTimePassed);
                                } else {

                                    $totalBuildTimePassed += $durationForOneUnit * $shipFinishedCnt;

                                    // add rest of the ships to the queue
                                    array_push($shipsLeftArray, array($unitID => ($unitCnt - $shipFinishedCnt)));

                                    // set the new start-time
                                    $this->b_hangar_start_time += round($totalBuildTimePassed);

                                    // skip the rest of the queue
                                    $skip = true;
                                }


                                // add the newly built ships
                                $currentShipCount = Loader::getFleetList()[$unitID]->getAmount();

                                $newShipCount = $currentShipCount + $shipFinishedCnt;

                                Loader::getFleetList()[$unitID]->setAmount(intval($newShipCount));

                                // update new shipcount in database
                                $stmt = $dbConnection->prepare('UPDATE ' . Config::$dbConfig['prefix'] . 'fleet SET ' . D_Units::getUnitName($unitID) . ' = ' . ($newShipCount) . ' WHERE planetId = ' . $this->planetID);

                                $stmt->execute();

                            } else {
                                // keep the ships in the queue
                                array_push($shipsLeftArray, array($unitID => $unitCnt));

                                if ($queuePos = 1) {
                                    $skip = true;
                                }
                            }
                        }


                        $queuePos++;
                    }

                    if ($someShipsFinished) {
                        // build new queue
                        $shipQueue = "";
                        for ($i = 0; $i < sizeof($shipsLeftArray); $i++) {
                            if (intval($shipsLeftArray[$i][key($shipsLeftArray[$i])]) > 0) {
                                $shipQueue .= key($shipsLeftArray[$i]) . "," . $shipsLeftArray[$i][key($shipsLeftArray[$i])] . ";";
                            }
                        }

                        // append the rest of the queue
                        foreach ($shipsLeftArray as $shipID => $amount) {
                            if (ctype_digit($shipID) && intval($shipID) > 0 &&
                                ctype_digit($amount) && intval($amount > 0)) {
                                $shipQueue .= $shipID . "," . ";";
                            }
                        }


                        // set new queue
                        $this->b_hangar_id = $shipQueue;
                    }


                    if (strlen($this->b_hangar_id) == 0) {
                        $this->b_hangar_start_time = 0;
                    }

                    $query .= ', b_hangar_start_time = :b_hangar_start_time, b_hangar_id = :b_hangar_id ';
                    $someShipsFinished = true;

                }

                $query .= ' WHERE planetID = :planetID;';

                $stmt = $dbConnection->prepare($query);


                // update the values of the planet-object
                $this->last_update = $time;
                $this->metal += $prod_metal;
                $this->crystal += $prod_crystal;
                $this->deuterium += $prod_deuterium;

                $this->energy_used = $cons_energy;
                $this->energy_max = $prod_energy;

                $stmt->bindParam(':last_update', $time);
                $stmt->bindParam(':metal', $this->metal);
                $stmt->bindParam(':crystal', $this->crystal);
                $stmt->bindParam(':deuterium', $this->deuterium);

                if ($someShipsFinished) {
                    $stmt->bindParam(':b_hangar_start_time', $this->b_hangar_start_time);
                    $stmt->bindParam(':b_hangar_id', $this->b_hangar_id);
                }

                $stmt->bindParam(':energy_used', $cons_energy);
                $stmt->bindParam(':energy_max', $prod_energy);
                $stmt->bindParam(':planetID', $this->planetID);

                $stmt->execute();
            }
        }

        private function getTotalEnergyProduction($baseIncome, $lvlSolarplant, $lvlFusionReactor, $lvlEnergyTech,
            $solarSatellites) : float {

            return array_sum(D_Units::getEnergyProduction(
                    $lvlSolarplant,
                    $lvlFusionReactor,
                    $lvlEnergyTech,
                    $solarSatellites,
                    $this->temp_max
                )
                ) + $baseIncome;
        }

        private function getTotalEnergyConsumption($lvl_metal, $lvl_crystal, $lvl_deuterium, $lvl_fusion) : float {

            return $this->getMetalMinePercent() / 100 * D_Units::getEnergyConsumption($lvl_metal) +
                $this->getCrystalMinePercent() / 100 * D_Units::getEnergyConsumption($lvl_crystal) +
                $this->getDeuteriumSynthesizerPercent() / 100 * D_Units::getEnergyConsumption($lvl_deuterium) +
                $this->getFusionReactorPercent() / 100 * D_Units::getEnergyConsumption($lvl_fusion);
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

        private function calculateMetalProduction($metalLvl, $storageCapacity, $prodFactor, $timeDiff,
            $baseIncome) : float {

            $prod_metal = 0;

            // do not produce more then there is storage!
            if ($this->metal < $storageCapacity) {
                $prod_metal = $prodFactor * $this->getMetalMinePercent() * (D_Units::getMetalProductionPerHour($metalLvl) / 3600) * $timeDiff + ($baseIncome / 3600 * $timeDiff);

                if ($this->metal + $prod_metal > $storageCapacity) {
                    $prod_metal = $storageCapacity - $this->metal;
                }
            }

            return $prod_metal;
        }

        private function calculateCrystalProduction($lvl_crystal, $storageCapacity, $prod_factor, $time_diff,
            $baseIncome) : float {

            $prod_crystal = 0;

            // do not produce more then there is storage!
            if ($this->crystal < $storageCapacity) {
                $prod_crystal = $prod_factor * $this->getCrystalMinePercent() * (D_Units::getCrystalProductionPerHour($lvl_crystal) / 3600) * $time_diff + ($baseIncome / 3600 * $time_diff);

                if ($this->crystal + $prod_crystal > $storageCapacity) {
                    $prod_crystal = ($storageCapacity - $this->deuterium);
                }
            }

            return $prod_crystal;
        }

        private function calculateDeuteriumProduction($lvl_deuterium, $storageCapacity, $prod_factor, $time_diff,
            $baseIncome) : float {

            $prod_deuterium = 0;

            // do not produce more then there is storage!
            if ($this->deuterium < $storageCapacity) {

                $incomeHourly = floor(10 * $lvl_deuterium * pow(1.1, $lvl_deuterium) * (1.28 - 0.002 * $this->getTempMax()));


                $prod_deuterium = $prod_factor * $this->getDeuteriumSynthesizerPercent() * ($incomeHourly / 3600) * $time_diff + ($baseIncome / 3600 * $time_diff);

                if ($this->deuterium + $prod_deuterium > $storageCapacity) {
                    $prod_deuterium = ($storageCapacity - $this->deuterium);
                }
            }

            return $prod_deuterium;
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

            $dbConnection = new Database();

            //--- check the passed values ------------------------------------------------------------------------------
            // check if only one or two are null
            if (empty($g) + empty($s) + empty($p) < 3) {
                throw new InvalidArgumentException("one argument was null");
            } else {
                if (empty($g) + empty($s) + empty($p) == 3) {


                    // check if coordinates are already used
                    do {
                        // create random coordinates
                        $this->galaxy = rand(1, Config::$gameConfig['max_galaxy']);
                        $this->system = rand(1, Config::$gameConfig['max_system']);
                        $this->planet = rand(1, Config::$gameConfig['max_planet']);

                        $stmt = $dbConnection->prepare('SELECT 1 FROM ' . Config::$dbConfig['prefix'] . 'planets WHERE galaxy = :g AND system = :s AND planet = :p;');

                        $stmt->bindParam(':g', $this->galaxy);
                        $stmt->bindParam(':s', $this->system);
                        $stmt->bindParam(':p', $this->planet);

                        $stmt->execute();

                    } while ($stmt->rowCount() > 0);


                } else {
                    if ($g > 1 && $g <= Config::$gameConfig['max_galaxy']) {
                        $this->galaxy = $g;
                    } else {
                        throw new InvalidArgumentException("galaxy out of range");
                    }

                    if ($s > 1 && $s <= Config::$gameConfig['max_system']) {
                        $this->system = $p;
                    } else {
                        throw new InvalidArgumentException("system out of range");
                    }

                    if ($p > 1 && $p <= Config::$gameConfig['max_planet']) {
                        $this->planet = $p;
                    } else {
                        throw new InvalidArgumentException("planet out of range");
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


                    $images = ['wuestenplanet', 'trockenplanet'];

                    $pimg = $images[rand(0, count($images) - 1)];
                    $randMax = 10;

                    if ($pimg == 'wuestenplanet') {
                        $randMax = 4;
                    }

                    $this->image = $pimg . sprintf("%02d", rand(1, $randMax));

                    break;
                case $p <= 10:
                    $this->temp_min = rand(-10, 20);
                    $this->temp_max = rand(40, 70);
                    $this->diameter = rand(11875, 15716);

                    $images = ['normaltempplanet', 'dschjungelplanet', 'gasplanet'];

                    $this->image = $images[rand(0, count($images) - 1)] . sprintf("%02d", rand(1, 10));

                    break;
                case $p <= 15:
                    $this->temp_min = rand(-150, -75);
                    $this->temp_max = rand(-55, 20);
                    $this->diameter = rand(8063, 14283);

                    $images = ['eisplanet', 'wasserplanet'];

                    $this->image = $images[rand(0, count($images) - 1)] . sprintf("%02d", rand(1, 10));

                    break;
            }

            $this->fields_max = round(($this->diameter / 1000) * ($this->diameter / 1000));

            //----------------------------------------------------------------------------------------------------------


            //check if ID is already taken
            do {
                $this->planetID = rand(0, 100000);

                $stmt = $dbConnection->prepare('SELECT ownerID FROM ' . Config::$dbConfig['prefix'] . 'planets WHERE planetID = :planetID;');

                $stmt->bindParam(':planetID', $this->planetID);

                $stmt->execute();

            } while ($stmt->rowCount() > 0);


            $stmt = $dbConnection->prepare('INSERT INTO ' . Config::$dbConfig['prefix'] . 'planets (planetID, ownerID, name, galaxy, system, planet, last_update, planet_type, image, diameter, fields_max, temp_min, temp_max) VALUES ' .
                '(:planetID, :ownerID, :name, :galaxy, :system, :planet, :last_update, :planet_type, :image, :diameter, :fields_max, :temp_min, :temp_max);');

            $stmt->bindParam(':planetID', $this->planetID);
            $stmt->bindParam(':ownerID', $this->ownerID);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':galaxy', $this->galaxy);
            $stmt->bindParam(':system', $this->system);
            $stmt->bindParam(':planet', $this->planet);
            $stmt->bindParam(':last_update', time());
            $stmt->bindParam(':planet_type', $type);
            $stmt->bindParam(':image', $this->image);
            $stmt->bindParam(':diameter', $this->diameter);
            $stmt->bindParam(':fields_max', $this->fields_max);
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
         * @param mixed $planetID
         */
        public function setPlanetID($planetID) : void {
            $this->planetID = $planetID;
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
         * @param mixed $ownerID
         */
        public function setOwnerID($ownerID) : void {
            $this->ownerID = $ownerID;
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
         * @param mixed $galaxy
         */
        public function setGalaxy($galaxy) : void {
            $this->galaxy = $galaxy;
        }

        /**
         * @return mixed
         */
        public function getSystem() {
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
        public function getPlanet() {
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
         * @param mixed $planet_type
         */
        public function setPlanetType($planet_type) : void {
            $this->planet_type = $planet_type;
        }

        /**
         * @return mixed
         */
        public function getImage() {
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
        public function getDiameter() {
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
         * @param mixed $fields_max
         */
        public function setFieldsMax($fields_max) : void {
            $this->fields_max = $fields_max;
        }

        /**
         * @return mixed
         */
        public function getTempMin() {
            return $this->temp_min;
        }

        /**
         * @param mixed $temp_min
         */
        public function setTempMin($temp_min) : void {
            $this->temp_min = $temp_min;
        }

        /**
         * @return mixed
         */
        public function getTempMax() {
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

        /**
         * @codeCoverageIgnore
         */
        public function print() : void {
            echo '<pre>';
            print_r($this);
            echo '</pre>';
        }

    }