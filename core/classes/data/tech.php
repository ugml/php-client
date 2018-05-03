<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    /**
     * This class maps the 'tech'-table to an php object.
     */
    class D_Tech {

        private $espionage_tech;

        private $computer_tech;

        private $weapon_tech;

        private $armour_tech;

        private $shielding_tech;

        private $energy_tech;

        private $hyperspace_tech;

        private $combustion_drive_tech;

        private $impulse_drive_tech;

        private $hyperspace_drive_tech;

        private $laser_tech;

        private $ion_tech;

        private $plasma_tech;

        private $intergalactic_research_tech;

        private $graviton_tech;

        /**
         * D_Tech constructor.
         * @param int $respionage_tech
         * @param int $rcomputer_tech
         * @param int $rweapon_tech
         * @param int $rarmour_tech
         * @param int $rshielding_tech
         * @param int $renergy_tech
         * @param int $rhyperspace_tech
         * @param int $rcombustion_drive_tech
         * @param int $rimpulse_drive_tech
         * @param int $rhyperspace_drive_tech
         * @param int $rlaser_tech
         * @param int $rion_tech
         * @param int $rplasma_tech
         * @param int $rintergalactic_research_tech
         * @param int $rgraviton_tech
         * @codeCoverageIgnore
         */
        public function __construct(
            int $respionage_tech, int $rcomputer_tech, int $rweapon_tech, int $rarmour_tech, int $rshielding_tech,
            int $renergy_tech, int $rhyperspace_tech,
            int $rcombustion_drive_tech, int $rimpulse_drive_tech, int $rhyperspace_drive_tech, int $rlaser_tech,
            int $rion_tech, int $rplasma_tech,
            int $rintergalactic_research_tech, int $rgraviton_tech
        ) {

            $this->espionage_tech = $respionage_tech;
            $this->computer_tech = $rcomputer_tech;
            $this->weapon_tech = $rweapon_tech;
            $this->armour_tech = $rarmour_tech;
            $this->shielding_tech = $rshielding_tech;
            $this->energy_tech = $renergy_tech;
            $this->hyperspace_tech = $rhyperspace_tech;
            $this->combustion_drive_tech = $rcombustion_drive_tech;
            $this->impulse_drive_tech = $rimpulse_drive_tech;
            $this->hyperspace_drive_tech = $rhyperspace_drive_tech;
            $this->laser_tech = $rlaser_tech;
            $this->ion_tech = $rion_tech;
            $this->plasma_tech = $rplasma_tech;
            $this->intergalactic_research_tech = $rintergalactic_research_tech;
            $this->graviton_tech = $rgraviton_tech;
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
         * @return mixed
         */
        public function getEspionageTech() : int {

            return $this->espionage_tech;
        }

        /**
         * @param mixed $espionage_tech
         */
        public function setEspionageTech(int $espionage_tech) : void {

            $this->espionage_tech = $espionage_tech;
        }

        /**
         * @return mixed
         */
        public function getComputerTech() : int {

            return $this->computer_tech;
        }

        /**
         * @param mixed $computer_tech
         */
        public function setComputerTech(int $computer_tech) : void {

            $this->computer_tech = $computer_tech;
        }

        /**
         * @return mixed
         */
        public function getWeaponTech() : int {

            return $this->weapon_tech;
        }

        /**
         * @param mixed $weapon_tech
         */
        public function setWeaponTech(int $weapon_tech) : void {

            $this->weapon_tech = $weapon_tech;
        }

        /**
         * @return mixed
         */
        public function getArmourTech() : int {

            return $this->armour_tech;
        }

        /**
         * @param mixed $armour_tech
         */
        public function setArmourTech(int $armour_tech) : void {

            $this->armour_tech = $armour_tech;
        }

        /**
         * @return mixed
         */
        public function getShieldingTech() : int {

            return $this->shielding_tech;
        }

        /**
         * @param mixed $shielding_tech
         */
        public function setShieldingTech(int $shielding_tech) : void {

            $this->shielding_tech = $shielding_tech;
        }

        /**
         * @return mixed
         */
        public function getEnergyTech() : int {

            return $this->energy_tech;
        }

        /**
         * @param mixed $energy_tech
         */
        public function setEnergyTech(int $energy_tech) : void {

            $this->energy_tech = $energy_tech;
        }

        /**
         * @return mixed
         */
        public function getHyperspaceTech() : int {

            return $this->hyperspace_tech;
        }

        /**
         * @param mixed $hyperspace_tech
         */
        public function setHyperspaceTech(int $hyperspace_tech) : void {

            $this->hyperspace_tech = $hyperspace_tech;
        }

        /**
         * @return mixed
         */
        public function getCombustionDriveTech() : int {

            return $this->combustion_drive_tech;
        }

        /**
         * @param mixed $combustion_tech
         */
        public function setCombustionDriveTech(int $combustion_tech) : void {

            $this->combustion_drive_tech = $combustion_tech;
        }

        /**
         * @return mixed
         */
        public function getImpulseDriveTech() : int {

            return $this->impulse_drive_tech;
        }

        /**
         * @param mixed $impulse_drive_tech
         */
        public function setImpulseDriveTech(int $impulse_drive_tech) : void {

            $this->impulse_drive_tech = $impulse_drive_tech;
        }

        /**
         * @return mixed
         */
        public function getHyperspaceDriveTech() : int {

            return $this->hyperspace_drive_tech;
        }

        /**
         * @param mixed $hyperspace_drive_tech
         */
        public function setHyperspaceDriveTech(int $hyperspace_drive_tech) : void {

            $this->hyperspace_drive_tech = $hyperspace_drive_tech;
        }

        /**
         * @return mixed
         */
        public function getLaserTech() : int {

            return $this->laser_tech;
        }

        /**
         * @param mixed $laser_tech
         */
        public function setLaserTech(int $laser_tech) : void {

            $this->laser_tech = $laser_tech;
        }

        /**
         * @return mixed
         */
        public function getIonTech() : int {

            return $this->ion_tech;
        }

        /**
         * @param mixed $ion_tech
         */
        public function setIonTech(int $ion_tech) : void {

            $this->ion_tech = $ion_tech;
        }

        /**
         * @return mixed
         */
        public function getPlasmaTech() : int {

            return $this->plasma_tech;
        }

        /**
         * @param mixed $plasma_tech
         */
        public function setPlasmaTech(int $plasma_tech) : void {

            $this->plasma_tech = $plasma_tech;
        }

        /**
         * @return mixed
         */
        public function getIntergalacticResearchTech() : int {

            return $this->intergalactic_research_tech;
        }

        /**
         * @param mixed $intergalactic_research_tech
         */
        public function setIntergalacticResearchTech(int $intergalactic_research_tech) : void {

            $this->intergalactic_research_tech = $intergalactic_research_tech;
        }

        /**
         * @return mixed
         */
        public function getGravitonTech() : int {

            return $this->graviton_tech;
        }

        /**
         * @param mixed $graviton_tech
         */
        public function setGravitonTech(int $graviton_tech) : void {

            $this->graviton_tech = $graviton_tech;
        }

    }
