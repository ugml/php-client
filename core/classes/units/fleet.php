<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class Unit_Fleet extends Unit_Unit {

        private $amount;

        private $costFactor;

        /**
         * Unit constructor.
         * @param $uID            - the internal unit-id
         * @param $uAmount        - the current amount of the unit
         * @param $uCostMetal     - the metal-cost for one unit/first level
         * @param $uCostCrystal   - the crystal-cost for one unit/first level
         * @param $uCostDeuterium - the deuterium-cost for one unit/first level
         * @param $uCostEnergy    - the energy-cost for one unit/first level
         * @param $uCostFactor    - the factor, at which the price is rising at each level
         */
        public function __construct($uID, $uAmount, $uCostMetal, $uCostCrystal, $uCostDeuterium, $uCostEnergy,
            $uCostFactor) {
            parent::__construct($uID, $uCostMetal, $uCostCrystal, $uCostDeuterium, $uCostEnergy, $uCostFactor);

            $this->amount = $uAmount;
            $this->costFactor = $uCostFactor;
        }

        /**
         * @return float the metal-costs for the given level
         */
        public function getCostMetal() : float {
            return floor(parent::getCostMetal());
        }

        /**
         * @return float the crystal-costs for the given level
         */
        public function getCostCrystal() : float {
            return floor(parent::getCostCrystal());
        }

        /**
         * @return float the deuterium-costs for the given level
         */
        public function getCostDeuterium() : float {
            return floor(parent::getCostDeuterium());
        }


        /**
         * @return float
         */
        public function getFactor() : float {
            return $this->costFactor;
        }

        public function getAmount() : int {
            return $this->amount;
        }
    }