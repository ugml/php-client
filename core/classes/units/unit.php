<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    abstract class U_Unit {

        /** @var int The unitID */
        private $unitID;

        /** @var float the metal cost */
        private $costMetal;

        /** @var float the crystal cost */
        private $costCrystal;

        /** @var float the deuterium cost */
        private $costDeuterium;

        /** @var float the energy cost */
        private $costEnergy;

        /** @var float the cost factor */
        private $costFactor;

        /**
         * Unit constructor.
         * @param int   $uUnitID        the internal unit-id
         * @param float $uCostMetal     the metal-cost for one unit/first level
         * @param float $uCostCrystal   the crystal-cost for one unit/first level
         * @param float $uCostDeuterium the deuterium-cost for one unit/first level
         * @param float $uCostEnergy    the energy-cost for one unit/first level
         * @param float $uCostFactor    the cost-factor
         */
        public function __construct(int $uUnitID, float $uCostMetal, float $uCostCrystal, float $uCostDeuterium,
            float $uCostEnergy, float $uCostFactor) {
            $this->unitID = $uUnitID;
            $this->costMetal = $uCostMetal;
            $this->costCrystal = $uCostCrystal;
            $this->costDeuterium = $uCostDeuterium;
            $this->costEnergy = $uCostEnergy;
            $this->costFactor = $uCostFactor;
        }

        /**
         * @return int the unit-id
         */
        public function getUnitId() : int {
            return $this->unitID;
        }

        /**
         * @return float the cost for one unit / first level
         */
        public function getCostMetal() : float {
            return $this->costMetal;
        }

        /**
         * @return float the cost for one unit / first level
         */
        public function getCostCrystal() : float {
            return $this->costCrystal;
        }

        /**
         * @return float the cost for one unit / first level
         */
        public function getCostDeuterium() : float {
            return $this->costDeuterium;
        }

        /**
         * @return float the cost for one unit / first level
         */
        public function getCostEnergy() : float {
            return $this->costEnergy;
        }

        /**
         * @return float the cost-factor
         */
        public function getFactor() : float {
            return $this->costFactor;
        }

    }