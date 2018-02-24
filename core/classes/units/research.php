<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class Unit_Research extends Unit_Unit {

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

        public function getCostMetal() : float {
            // TODO: Implement getCostMetal() method.
        }

        public function getCostCrystal() : float {
            // TODO: Implement getCostCrystal() method.
        }

        public function getCostDeuterium() : float {
            // TODO: Implement getCostDeuterium() method.
        }

        public function getCostEnergy() : float {
            // TODO: Implement getCostEnergy() method.
        }

        /**
         * @return int
         */
        public function getLevel() : int {
            return $this->level;
        }
    }