<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class U_Research extends U_Unit {

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
         * Returns the metal-costs for the next level
         * @return float the metal-costs for the next level
         */
        public function getCostMetal() : float {
            return floor(parent::getCostMetal() * (parent::getFactor() ** $this->level));
        }

        /**
         * Returns the metal-costs for the next level
         * @return float the metal-costs for the next level
         */
        public function getCostCrystal() : float {
            return floor(parent::getCostCrystal() * pow(parent::getFactor(), $this->level));
        }

        /**
         * Returns the deuterium-costs for the next level
         * @return float the deuterium-costs for the next level
         */
        public function getCostDeuterium() : float {
            return floor(parent::getCostDeuterium() * pow(parent::getFactor(), $this->level));
        }

        public function getCostEnergy() : float {
            // TODO: Implement getCostEnergy() method.
            return 0.0;
        }

        /**
         * @return int
         */
        public function getLevel() : int {
            return $this->level;
        }
    }