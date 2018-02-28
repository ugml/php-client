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
         */
        public function print() : void {

            echo '<pre>';
            print_r($this);
            echo '</pre>';
        }

        /**
         * @return int
         */
        public function getSmallCargoShip() : int {

            return intval($this->small_cargo_ship);
        }

        /**
         * @param int $small_cargo_ship
         */
        public function setSmallCargoShip(int $small_cargo_ship) : void {

            $this->small_cargo_ship = $small_cargo_ship;
        }

        /**
         * @return int
         */
        public function getLargeCargoShip() : int {

            return intval($this->large_cargo_ship);
        }

        /**
         * @param int $large_cargo_ship
         */
        public function setLargeCargoShip(int $large_cargo_ship) : void {

            $this->large_cargo_ship = $large_cargo_ship;
        }

        /**
         * @return int
         */
        public function getLightFighter() : int {

            return intval($this->light_fighter);
        }

        /**
         * @param int $light_fighter
         */
        public function setLightFighter(int $light_fighter) : void {

            $this->light_fighter = $light_fighter;
        }

        /**
         * @return int
         */
        public function getHeavyFighter() : int {

            return intval($this->heavy_fighter);
        }

        /**
         * @param int $heavy_fighter
         */
        public function setHeavyFighter(int $heavy_fighter) : void {

            $this->heavy_fighter = $heavy_fighter;
        }

        /**
         * @return int
         */
        public function getCruiser() : int {

            return intval($this->cruiser);
        }

        /**
         * @param int $cruiser
         */
        public function setCruiser(int $cruiser) : void {

            $this->cruiser = $cruiser;
        }

        /**
         * @return int
         */
        public function getBattleship() : int {

            return intval($this->battleship);
        }

        /**
         * @param int $battleship
         */
        public function setBattleship(int $battleship) : void {

            $this->battleship = $battleship;
        }

        /**
         * @return int
         */
        public function getColonyShip() : int {

            return intval($this->colony_ship);
        }

        /**
         * @param int $colony_ship
         */
        public function setColonyShip(int $colony_ship) : void {

            $this->colony_ship = $colony_ship;
        }

        /**
         * @return int
         */
        public function getRecycler() : int {

            return intval($this->recycler);
        }

        /**
         * @param int $recycler
         */
        public function setRecycler(int $recycler) : void {

            $this->recycler = $recycler;
        }

        /**
         * @return int
         */
        public function getEspionageProbe() : int {

            return intval($this->espionage_probe);
        }

        /**
         * @param int $espionage_probe
         */
        public function setEspionageProbe(int $espionage_probe) : void {

            $this->espionage_probe = $espionage_probe;
        }

        /**
         * @return int
         */
        public function getBomber() : int {

            return intval($this->bomber);
        }

        /**
         * @param int $bomber
         */
        public function setBomber(int $bomber) : void {

            $this->bomber = $bomber;
        }

        /**
         * @return int
         */
        public function getSolarSatellite() : int {

            return intval($this->solar_satellite);
        }

        /**
         * @param int $solar_satellite
         */
        public function setSolarSatellite(int $solar_satellite) : void {

            $this->solar_satellite = $solar_satellite;
        }

        /**
         * @return int
         */
        public function getDestroyer() : int {

            return intval($this->destroyer);
        }

        /**
         * @param int $destroyer
         */
        public function setDestroyer(int $destroyer) : void {

            $this->destroyer = $destroyer;
        }

        /**
         * @return int
         */
        public function getBattlecruiser() : int {

            return intval($this->battlecruiser);
        }

        /**
         * @param int $battlecruiser
         */
        public function setBattlecruiser(int $battlecruiser) : void {

            $this->battlecruiser = $battlecruiser;
        }

        /**
         * @return int
         */
        public function getDeathstar() : int {

            return intval($this->deathstar);
        }

        /**
         * @param int $deathstar
         */
        public function setDeathstar(int $deathstar) : void {

            $this->deathstar = $deathstar;
        }

    }
