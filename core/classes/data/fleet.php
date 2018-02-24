<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class Data_Fleet {

        private $small_cargo_ship;

        private $large_cargo_ship;

        private $light_fighter;

        private $heavy_fighter;

        private $cruiser;

        private $battleship;

        private $colony_ship;

        private $recycler;

        private $espionage_probe;

        private $bomber;

        private $solar_satellite;

        private $destroyer;

        private $battlecruiser;

        private $deathstar;

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

        public function printFleet() : void {

            echo '<pre>';
            print_r($this);
            echo '</pre>';
        }

        /**
         * @return mixed
         */
        public function getSmallCargoShip() : int {

            return intval($this->small_cargo_ship);
        }

        /**
         * @param mixed $small_cargo_ship
         */
        public function setSmallCargoShip($small_cargo_ship) : void {

            $this->small_cargo_ship = $small_cargo_ship;
        }

        /**
         * @return mixed
         */
        public function getLargeCargoShip() : int {

            return intval($this->large_cargo_ship);
        }

        /**
         * @param mixed $large_cargo_ship
         */
        public function setLargeCargoShip($large_cargo_ship) : void {

            $this->large_cargo_ship = $large_cargo_ship;
        }

        /**
         * @return mixed
         */
        public function getLightFighter() : int {

            return intval($this->light_fighter);
        }

        /**
         * @param mixed $light_fighter
         */
        public function setLightFighter($light_fighter) : void {

            $this->light_fighter = $light_fighter;
        }

        /**
         * @return mixed
         */
        public function getHeavyFighter() : int {

            return intval($this->heavy_fighter);
        }

        /**
         * @param mixed $heavy_fighter
         */
        public function setHeavyFighter($heavy_fighter) : void {

            $this->heavy_fighter = $heavy_fighter;
        }

        /**
         * @return mixed
         */
        public function getCruiser() : int {

            return intval($this->cruiser);
        }

        /**
         * @param mixed $cruiser
         */
        public function setCruiser($cruiser) : void {

            $this->cruiser = $cruiser;
        }

        /**
         * @return mixed
         */
        public function getBattleship() : int {

            return intval($this->battleship);
        }

        /**
         * @param mixed $battleship
         */
        public function setBattleship($battleship) : void {

            $this->battleship = $battleship;
        }

        /**
         * @return mixed
         */
        public function getColonyShip() : int {

            return intval($this->colony_ship);
        }

        /**
         * @param mixed $colony_ship
         */
        public function setColonyShip($colony_ship) : void {

            $this->colony_ship = $colony_ship;
        }

        /**
         * @return mixed
         */
        public function getRecycler() : int {

            return intval($this->recycler);
        }

        /**
         * @param mixed $recycler
         */
        public function setRecycler($recycler) : void {

            $this->recycler = $recycler;
        }

        /**
         * @return mixed
         */
        public function getEspionageProbe() : int {

            return intval($this->espionage_probe);
        }

        /**
         * @param mixed $espionage_probe
         */
        public function setEspionageProbe($espionage_probe) : void {

            $this->espionage_probe = $espionage_probe;
        }

        /**
         * @return mixed
         */
        public function getBomber() : int {

            return intval($this->bomber);
        }

        /**
         * @param mixed $bomber
         */
        public function setBomber($bomber) : void {

            $this->bomber = $bomber;
        }

        /**
         * @return mixed
         */
        public function getSolarSatellite() : int {

            return intval($this->solar_satellite);
        }

        /**
         * @param mixed $solar_satellite
         */
        public function setSolarSatellite($solar_satellite) : void {

            $this->solar_satellite = $solar_satellite;
        }

        /**
         * @return mixed
         */
        public function getDestroyer() : int {

            return intval($this->destroyer);
        }

        /**
         * @param mixed $destroyer
         */
        public function setDestroyer($destroyer) : void {

            $this->destroyer = $destroyer;
        }

        /**
         * @return mixed
         */
        public function getBattlecruiser() : int {

            return intval($this->battlecruiser);
        }

        /**
         * @param mixed $battlecruiser
         */
        public function setBattlecruiser($battlecruiser) : void {

            $this->battlecruiser = $battlecruiser;
        }

        /**
         * @return mixed
         */
        public function getDeathstar() : int {

            return intval($this->deathstar);
        }

        /**
         * @param mixed $deathstar
         */
        public function setDeathstar($deathstar) : void {

            $this->deathstar = $deathstar;
        }

    }
