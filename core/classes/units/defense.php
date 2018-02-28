<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class U_Defense extends U_Unit {

        /** @var int The current amount */
        private $amount;

        /**
         * Unit constructor.
         * @param int $uID                the internal unit-id
         * @param int $uAmount            the current amount of the unit
         * @param float $uCostMetal       the metal-cost for one unit/first level
         * @param float $uCostCrystal     the crystal-cost for one unit/first level
         * @param float $uCostDeuterium   the deuterium-cost for one unit/first level
         * @param float $uCostEnergy      the energy-cost for one unit/first level
         * @param float $uCostFactor      the factor, at which the price is rising at each level
         */
        public function __construct(int $uID, int $uAmount, float $uCostMetal, float $uCostCrystal, float $uCostDeuterium, float $uCostEnergy,
            $uCostFactor) {
            parent::__construct($uID, $uCostMetal, $uCostCrystal, $uCostDeuterium, $uCostEnergy, $uCostFactor);

            $this->amount = $uAmount;
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
    }