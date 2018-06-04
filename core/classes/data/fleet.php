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
         * Return the level of the fleet, given its id
         * @param int $id the fleet id
         * @return int the level of the fleet
         */
        public function getFleetByID(int $id) : int {

            switch ($id) {
                case 201:
                    return $this->getSmallCargoShip();
                    break;
                case 202:
                    return $this->getLargeCargoShip();
                    break;
                case 203:
                    return $this->getLightFighter();
                    break;
                case 204:
                    return $this->getHeavyFighter();
                    break;
                case 205:
                    return $this->getCruiser();
                    break;
                case 206:
                    return $this->getBattleship();
                    break;
                case 207:
                    return $this->getColonyShip();
                    break;
                case 208:
                    return $this->getRecycler();
                    break;
                case 209:
                    return $this->getEspionageProbe();
                    break;
                case 210:
                    return $this->getBomber();
                    break;
                case 211:
                    return $this->getSolarSatellite();
                    break;
                case 212:
                    return $this->getDestroyer();
                    break;
                case 213:
                    return $this->getBattlecruiser();
                    break;
                case 214:
                    return $this->getDeathstar();
                    break;
            }

            return -1;
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

            if ($amount >= 0) {
                $this->small_cargo_ship = $amount;
            }
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

            if ($amount >= 0) {
                $this->large_cargo_ship = $amount;
            }
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

            if ($amount >= 0) {
                $this->light_fighter = $amount;
            }
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

            if ($amount >= 0) {
                $this->heavy_fighter = $amount;
            }
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

            if ($amount >= 0) {
                $this->cruiser = $amount;
            }
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

            if ($amount >= 0) {
                $this->battleship = $amount;
            }
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

            if ($amount >= 0) {
                $this->colony_ship = $amount;
            }
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

            if ($amount >= 0) {
                $this->recycler = $amount;
            }
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

            if ($amount >= 0) {
                $this->espionage_probe = $amount;
            }
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

            if ($amount >= 0) {
                $this->bomber = $amount;
            }
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

            if ($amount >= 0) {
                $this->solar_satellite = $amount;
            }
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

            if ($amount >= 0) {
                $this->destroyer = $amount;
            }
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

            if ($amount >= 0) {
                $this->battlecruiser = $amount;
            }
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

            if ($amount >= 0) {
                $this->deathstar = $amount;
            }
        }



        /**
         * Sets the level of the fleet, given its id and new level
         * @param int $id    the id of the fleet
         * @param int $level the new level of the fleet
         */
        public function setFleetByID(int $id, int $level) {

            switch ($id) {
                case 201:
                    $this->setSmallCargoShip($level);
                    break;
                case 202:
                    $this->setLargeCargoShip($level);
                    break;
                case 203:
                    $this->setLightFighter($level);
                    break;
                case 204:
                    $this->setHeavyFighter($level);
                    break;
                case 205:
                    $this->setCruiser($level);
                    break;
                case 206:
                    $this->setBattleship($level);
                    break;
                case 207:
                    $this->setColonyShip($level);
                    break;
                case 208:
                    $this->setRecycler($level);
                    break;
                case 209:
                    $this->setEspionageProbe($level);
                    break;
                case 210:
                    $this->setBomber($level);
                    break;
                case 211:
                    $this->setSolarSatellite($level);
                    break;
                case 212:
                    $this->setDestroyer($level);
                    break;
                case 213:
                    $this->setBattlecruiser($level);
                    break;
                case 214:
                    $this->setDeathstar($level);
                    break;
            }
        }

    }
