<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    abstract class Unit {

        private $unitID;
        private $costMetal;
        private $costCrystal;
        private $costDeuterium;
        private $costEnergy;

        /**
         * Unit constructor.
         * @param $uUnitID - the internal unit-id
         * @param $uCostMetal - the metal-cost for one unit/first level
         * @param $uCostCrystal - the crystal-cost for one unit/first level
         * @param $uCostDeuterium - the deuterium-cost for one unit/first level
         * @param $uCostEnergy - the energy-cost for one unit/first level
         */
        public function __construct($uUnitID, $uCostMetal, $uCostCrystal, $uCostDeuterium, $uCostEnergy) {
            $this->unitID = $uUnitID;
            $this->costMetal = $uCostMetal;
            $this->costCrystal = $uCostCrystal;
            $this->costDeuterium = $uCostDeuterium;
            $this->costEnergy = $uCostEnergy;
        }

        /**
         * @return int the unit-id
         */
        public function getUnitId() : int {
            return $this->id;
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



    }