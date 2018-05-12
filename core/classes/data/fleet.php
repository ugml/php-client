<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    /**
     * This class maps the 'fleet'-table to an php object.
     */
    class D_Fleet {

        /** @var int Amount of Small Cargo Ship */
        private $small_cargo_ship;

        /** @var int Amount of Large Cargo Ship */
        private $large_cargo_ship;

        /** @var int Amount of Light Fighter */
        private $light_fighter;

        /** @var int Amount of Heavy Fighter */
        private $heavy_fighter;

        /** @var int Amount of Cruiser */
        private $cruiser;

        /** @var int Amount of Battleship */
        private $battleship;

        /** @var int Amount of Colony Ship */
        private $colony_ship;

        /** @var int Amount of Recycler */
        private $recycler;

        /** @var int Amount of Espionage Probe */
        private $espionage_probe;

        /** @var int Amount of Bomber */
        private $bomber;

        /** @var int Amount of Solar Satellite */
        private $solar_satellite;

        /** @var int Amount of Destroyer */
        private $destroyer;

        /** @var int Amount of Battlecruiser */
        private $battlecruiser;

        /** @var int Amount of Deathstar */
        private $deathstar;

        /**
         * D_Fleet constructor.
         * The parameters are the different amounts of the fleet
         * @param int $fsmall_cargo_ship
         * @param int $flarge_cargo_ship
         * @param int $flight_fighter
         * @param int $fheavy_fighter
         * @param int $fcruiser
         * @param int $fbattleship
         * @param int $fcolony_ship
         * @param int $frecycler
         * @param int $fespionage_probe
         * @param int $fbomber
         * @param int $fsolar_satellite
         * @param int $fdestroyer
         * @param int $fbattlecruiser
         * @param int $fdeathstar
         */
        public function __construct(
            int $fsmall_cargo_ship, int $flarge_cargo_ship, int $flight_fighter, int $fheavy_fighter, int $fcruiser,
            int $fbattleship, int $fcolony_ship,
            int $frecycler, int $fespionage_probe, int $fbomber, int $fsolar_satellite, int $fdestroyer,
            int $fbattlecruiser, int $fdeathstar
        ) {

            $this->small_cargo_ship = $fsmall_cargo_ship;
            $this->large_cargo_ship = $flarge_cargo_ship;
            $this->light_fighter = $flight_fighter;
            $this->heavy_fighter = $fheavy_fighter;
            $this->cruiser = $fcruiser;
            $this->battleship = $fbattleship;
            $this->colony_ship = $fcolony_ship;
            $this->recycler = $frecycler;
            $this->espionage_probe = $fespionage_probe;
            $this->bomber = $fbomber;
            $this->solar_satellite = $fsolar_satellite;
            $this->destroyer = $fdestroyer;
            $this->battlecruiser = $fbattlecruiser;
            $this->deathstar = $fdeathstar;
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
         * Returns the current amount amount
         * @return int the current amont
         */
        public function getSmallCargoShip() : int {

            return intval($this->small_cargo_ship);
        }

        /**
         * Sets the current amount
         * @param int the current amount
         */
        public function setSmallCargoShip(int $amount) : void {

            if($amount >= 0) $this->small_cargo_ship = $amount;
        }

        /**
         * Returns the current amount amount
         * @return int the current amont
         */
        public function getLargeCargoShip() : int {

            return intval($this->large_cargo_ship);
        }

        /**
         * Sets the current amount
         * @param int the current amount
         */
        public function setLargeCargoShip(int $amount) : void {

            if($amount >= 0) $this->large_cargo_ship = $amount;
        }

        /**
         * Returns the current amount amount
         * @return int the current amont
         */
        public function getLightFighter() : int {

            return intval($this->light_fighter);
        }

        /**
         * Sets the current amount
         * @param int the current amount
         */
        public function setLightFighter(int $amount) : void {

            if($amount >= 0) $this->light_fighter = $amount;
        }

        /**
         * Returns the current amount amount
         * @return int the current amont
         */
        public function getHeavyFighter() : int {

            return intval($this->heavy_fighter);
        }

        /**
         * Sets the current amount
         * @param int the current amount
         */
        public function setHeavyFighter(int $amount) : void {

            if($amount >= 0) $this->heavy_fighter = $amount;
        }

        /**
         * Returns the current amount amount
         * @return int the current amont
         */
        public function getCruiser() : int {

            return intval($this->cruiser);
        }

        /**
         * Sets the current amount
         * @param int the current amount
         */
        public function setCruiser(int $amount) : void {

            if($amount >= 0) $this->cruiser = $amount;
        }

        /**
         * Returns the current amount amount
         * @return int the current amont
         */
        public function getBattleship() : int {

            return intval($this->battleship);
        }

        /**
         * Sets the current amount
         * @param int the current amount
         */
        public function setBattleship(int $amount) : void {

            if($amount >= 0) $this->battleship = $amount;
        }

        /**
         * Returns the current amount amount
         * @return int the current amont
         */
        public function getColonyShip() : int {

            return intval($this->colony_ship);
        }

        /**
         * Sets the current amount
         * @param int the current amount
         */
        public function setColonyShip(int $amount) : void {

            if($amount >= 0) $this->colony_ship = $amount;
        }

        /**
         * Returns the current amount amount
         * @return int the current amont
         */
        public function getRecycler() : int {

            return intval($this->recycler);
        }

        /**
         * Sets the current amount
         * @param int the current amount
         */
        public function setRecycler(int $amount) : void {

            if($amount >= 0) $this->recycler = $amount;
        }

        /**
         * Returns the current amount amount
         * @return int the current amont
         */
        public function getEspionageProbe() : int {

            return intval($this->espionage_probe);
        }

        /**
         * Sets the current amount
         * @param int the current amount
         */
        public function setEspionageProbe(int $amount) : void {

            if($amount >= 0) $this->espionage_probe = $amount;
        }

        /**
         * Returns the current amount amount
         * @return int the current amont
         */
        public function getBomber() : int {

            return intval($this->bomber);
        }

        /**
         * Sets the current amount
         * @param int the current amount
         */
        public function setBomber(int $amount) : void {

            if($amount >= 0) $this->bomber = $amount;
        }

        /**
         * Returns the current amount amount
         * @return int the current amont
         */
        public function getSolarSatellite() : int {

            return intval($this->solar_satellite);
        }

        /**
         * Sets the current amount
         * @param int the current amount
         */
        public function setSolarSatellite(int $amount) : void {

            if($amount >= 0) $this->solar_satellite = $amount;
        }

        /**
         * Returns the current amount amount
         * @return int the current amont
         */
        public function getDestroyer() : int {

            return intval($this->destroyer);
        }

        /**
         * Sets the current amount
         * @param int the current amount
         */
        public function setDestroyer(int $amount) : void {

            if($amount >= 0) $this->destroyer = $amount;
        }

        /**
         * Returns the current amount amount
         * @return int the current amount
         */
        public function getBattlecruiser() : int {

            return intval($this->battlecruiser);
        }

        /**
         * Sets the current amount
         * @param int the current amount
         */
        public function setBattlecruiser(int $amount) : void {

            if($amount >= 0) $this->battlecruiser = $amount;
        }

        /**
         * Returns the current amount amount
         * @return int the current amont
         */
        public function getDeathstar() : int {

            return intval($this->deathstar);
        }

        /**
         * Sets the current amount
         * @param int the current amount
         */
        public function setDeathstar(int $amount) : void {

            if($amount >= 0) $this->deathstar = $amount;
        }

        /**
         * Return the level of the defense, given its id
         * @param int $id the defense id
         * @return int the level of the defense
         */
        public function getDefenseByID(int $id) : int {

            switch($id) {
                case 301:
                    $this->getRocketLauncher();
                    break;
                case 302:
                    $this->getLightLaser();
                    break;
                case 303:
                    $this->getHeavyLaser();
                    break;
                case 304:
                    $this->getGaussCannon();
                    break;
                case 305:
                    $this->getIonCannon();
                    break;
                case 306:
                    $this->getPlasmaTurret();
                    break;
                case 307:
                    $this->getSmallShieldDome();
                    break;
                case 308:
                    $this->getLargeShieldDome();
                    break;
                case 309:
                    $this->getAntiBallisticMissile();
                    break;
                case 310:
                    $this->getInterplanetaryMissile();
                    break;
            }
        }

        /**
         * Sets the level of the defense, given its id and new level
         * @param int $id the id of the defense
         * @param int $level the new level of the defense
         */
        public function setDefenseByID(int $id, int $level) {

            switch($id) {
                case 301:
                    $this->setRocketLauncher($level);
                    break;
                case 302:
                    $this->setLightLaser($level);
                    break;
                case 303:
                    $this->setHeavyLaser($level);
                    break;
                case 304:
                    $this->setGaussCannon($level);
                    break;
                case 305:
                    $this->setIonCannon($level);
                    break;
                case 306:
                    $this->setPlasmaTurret($level);
                    break;
                case 307:
                    $this->setSmallShieldDome($level);
                    break;
                case 308:
                    $this->setLargeShieldDome($level);
                    break;
                case 309:
                    $this->setAntiBallisticMissile($level);
                    break;
                case 310:
                    $this->setInterplanetaryMissile($level);
                    break;
            }
        }

    }
