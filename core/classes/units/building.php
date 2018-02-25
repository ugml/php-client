<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class Unit_Building extends Unit_Unit {

        private $level;

        private $costFactor;

        /**
         * Unit constructor.
         * @param $uID            - the internal unit-id
         * @param $uLevel         - the current level of the unit
         * @param $uCostMetal     - the metal-cost for one unit/first level
         * @param $uCostCrystal   - the crystal-cost for one unit/first level
         * @param $uCostDeuterium - the deuterium-cost for one unit/first level
         * @param $uCostEnergy    - the energy-cost for one unit/first level
         * @param $uCostFactor    - the factor, at which the price is rising at each level
         */
        public function __construct($uID, $uLevel, $uCostMetal, $uCostCrystal, $uCostDeuterium, $uCostEnergy,
            $uCostFactor) {
            parent::__construct($uID, $uCostMetal, $uCostCrystal, $uCostDeuterium, $uCostEnergy, $uCostFactor);

            $this->level = $uLevel;
            $this->costFactor = $uCostFactor;
        }

        /**
         * @return float the metal-costs for the given level
         */
        public function getCostMetal() : float {
            return floor(parent::getCostMetal() * $this->costFactor ** $this->level);
        }

        /**
         * @return float the crystal-costs for the given level
         */
        public function getCostCrystal() : float {
            return floor(parent::getCostCrystal() * pow($this->costFactor, $this->level));
        }

        /**
         * @return float the deuterium-costs for the given level
         */
        public function getCostDeuterium() : float {
            return floor(parent::getCostDeuterium() * pow($this->costFactor, $this->level));
        }

        /**
         * @return float the energy-costs for the given level
         */
        public function getCostEnergy() : float {
            return floor(parent::getCostEnergy() * pow($this->costFactor, $this->level));
        }

        /**
         * @return float
         */
        public function getFactor() : float {
            return $this->costFactor;
        }

        /**
         * @return float the energy-consumption for the given level
         */
        public function getEnergyConsumption() : float {
            global $data;

            // metal-mine
            if (parent::getUnitId() == 1) {
                return ceil(10 * $this->level * pow(1.1, $this->level) * ($data->getPlanet()
                            ->getMetalMinePercent() / 100));
            }

            // crystal-mine
            if (parent::getUnitId() == 2) {
                return ceil(10 * $this->level * pow(1.1, $this->level) * ($data->getPlanet()
                            ->getCrystalMinePercent() / 100));
            }

            // deuterium-mine
            if (parent::getUnitId() == 3) {
                return ceil(20 * $this->level * pow(1.1, $this->level) * ($data->getPlanet()
                            ->getDeuteriumSynthesizerPercent() / 100));
            }

            return 0;
        }

        /**
         * @return int
         */
        public function getLevel() : int {
            return $this->level;
        }
    }