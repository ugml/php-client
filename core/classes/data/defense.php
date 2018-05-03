<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    /**
     * This class maps the 'defense'-table to an php object.
     */
    class D_Defense {

        /** @var int Amount of Rocket Launcher */
        private $rocket_launcher;

        /** @var int Amount of Light Laser */
        private $light_laser;

        /** @var int Amount of Heavy laser */
        private $heavy_laser;

        /** @var int Amount of Ion Cannon */
        private $ion_cannon;

        /** @var int Amount of Gauss Cannon*/
        private $gauss_cannon;

        /** @var int Amount of Plasma Turret */
        private $plasma_turret;

        /** @var int Amount of Small Shield Dome */
        private $small_shield_dome;

        /** @var int Amount of Large Shield Dome */
        private $large_shield_dome;

        /** @var int Amount of Anti Ballistic Missile */
        private $anti_ballistic_missile;

        /** @var int Amount of Interplanetary Missile */
        private $interplanetary_missile;

        /**
         * D_Defense constructor.
         * The parameters are the different amounts of the defense
         * @param int $drocket_launcher
         * @param int $dlight_laser
         * @param int $dheavy_laser
         * @param int $dion_cannon
         * @param int $dgauss_cannon
         * @param int $dplasma_turret
         * @param int $dsmall_shield_dome
         * @param int $dlarge_shield_dome
         * @param int $danti_ballistic_missile
         * @param int $dinterplanetary_missile
         */
        public function __construct(
            int $drocket_launcher, int $dlight_laser, int $dheavy_laser, int $dion_cannon, int $dgauss_cannon,
            int $dplasma_turret, int $dsmall_shield_dome,
            int $dlarge_shield_dome, int $danti_ballistic_missile, int $dinterplanetary_missile
        ) {

            $this->rocket_launcher = $drocket_launcher;
            $this->light_laser = $dlight_laser;
            $this->heavy_laser = $dheavy_laser;
            $this->ion_cannon = $dion_cannon;
            $this->gauss_cannon = $dgauss_cannon;
            $this->plasma_turret = $dplasma_turret;
            $this->small_shield_dome = $dsmall_shield_dome;
            $this->large_shield_dome = $dlarge_shield_dome;
            $this->anti_ballistic_missile = $danti_ballistic_missile;
            $this->interplanetary_missile = $dinterplanetary_missile;
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
         * Returns the current amount
         * @return int the current amount
         */
        public function getRocketLauncher() : int {

            return $this->rocket_launcher;
        }

        /**
         * Sets the current amount
         * @param int $rocket_launcher the new amount
         */
        public function setRocketLauncher(int $amount) : void {

            $this->rocket_launcher = $amount;
        }

        /**
         * Returns the current amount
         * @return int the current amount
         */
        public function getLightLaser() : int {

            return $this->light_laser;
        }

        /**
         * Sets the current amount
         * @param int $light_laser the new amount
         */
        public function setLightLaser(int $amount) : void {

            $this->light_laser = $amount;
        }

        /**
         * Returns the current amount amount
         * @return int the current amount
         */
        public function getHeavyLaser() : int {

            return $this->heavy_laser;
        }

        /**
         * Sets the current amount
         * @param int $heavy_laser the new amount
         */
        public function setHeavyLaser(int $amount) : void {

            $this->heavy_laser = $amount;
        }

        /**
         * Returns the current amount amount
         * @return int the current amount
         */
        public function getIonCannon() : int {

            return $this->ion_cannon;
        }

        /**
         * Sets the current amount
         * @param int $ion_cannon the new amount
         */
        public function setIonCannon(int $amount) : void {

            $this->ion_cannon = $amount;
        }

        /**
         * Returns the current amount
         * @return int the current amount
         */
        public function getGaussCannon() : int {

            return $this->gauss_cannon;
        }

        /**
         * Sets the current amount
         * @param int $gauss_cannon the new amount
         */
        public function setGaussCannon(int $amount) : void {

            $this->gauss_cannon = $amount;
        }

        /**
         * Returns the current amount
         * @return int the current amount
         */
        public function getPlasmaTurret() : int {

            return $this->plasma_turret;
        }

        /**
         * Sets the current amount
         * @param int $plasma_turret the new amount
         */
        public function setPlasmaTurret(int $amount) : void {

            $this->plasma_turret = $amount;
        }

        /**
         * Returns the current amount
         * @return int the current amount
         */
        public function getSmallShieldDome() : int {

            return $this->small_shield_dome;
        }

        /**
         * Sets the current amount
         * @param int $small_shield_dome the new amount
         */
        public function setSmallShieldDome(int $amount) : void {

            $this->small_shield_dome = $amount;
        }

        /**
         * Returns the current amount
         * @return int the current amount
         */
        public function getLargeShieldDome() : int {

            return $this->large_shield_dome;
        }

        /**
         * Sets the current amount
         * @param int $large_shield_dome the new amount
         */
        public function setLargeShieldDome(int $amount) : void {

            $this->large_shield_dome = $amount;
        }

        /**
         * Returns the current amount
         * @return int the current amount
         */
        public function getAntiBallisticMissile() : int {

            return $this->anti_ballistic_missile;
        }

        /**
         * Sets the current amount
         * @param int $anti_ballistic_missile the new amount
         */
        public function setAntiBallisticMissile(int $amount) : void {

            $this->anti_ballistic_missile = $amount;
        }

        /**
         * Returns the current amount
         * @return int the current amount
         */
        public function getInterplanetaryMissile() : int {

            return $this->interplanetary_missile;
        }

        /**
         * Sets the current amount
         * @param int $interplanetary_missile the new amount
         */
        public function setInterplanetaryMissile(int $amount) : void {

            $this->interplanetary_missile = $amount;
        }

    }
