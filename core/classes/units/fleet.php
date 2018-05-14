<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class U_Fleet extends U_Unit {

        /** @var int The current amount */
        private $amount;

        /**
         * Unit constructor.
         * @param int   $uID            - the internal unit-id
         * @param int   $uAmount        - the current amount of the unit
         * @param float $uCostMetal     - the metal-cost for one unit/first level
         * @param float $uCostCrystal   - the crystal-cost for one unit/first level
         * @param float $uCostDeuterium - the deuterium-cost for one unit/first level
         * @param float $uCostEnergy    - the energy-cost for one unit/first level
         * @param float $uCostFactor    - the factor, at which the price is rising at each level
         */
        public function __construct($uID, $uAmount, $uCostMetal, $uCostCrystal, $uCostDeuterium, $uCostEnergy,
            $uCostFactor) {
            parent::__construct($uID, $uCostMetal, $uCostCrystal, $uCostDeuterium, $uCostEnergy, $uCostFactor);

            $this->amount = $uAmount;
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

        public function getAmount() : int {
            return $this->amount;
        }

        public function setAmount($amt) {
            $this->amount = $amt;
        }
    }