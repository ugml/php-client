<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class U_Building extends U_Unit {

        /** @var int the current level */
        private $level;

        /**
         * Unit constructor.
         * @param int $uID                  the internal unit-id
         * @param int $uLevel               the current level of the unit
         * @param float $uCostMetal         the metal-cost for one unit/first level
         * @param float $uCostCrystal       the crystal-cost for one unit/first level
         * @param float $uCostDeuterium     the deuterium-cost for one unit/first level
         * @param float $uCostEnergy        the energy-cost for one unit/first level
         * @param float $uCostFactor        the factor, at which the price is rising at each level
         */
        public function __construct(int $uID, int $uLevel, float $uCostMetal, float $uCostCrystal, float $uCostDeuterium, float $uCostEnergy,
            float $uCostFactor) {

            // TODO: check unitID < 100

            parent::__construct($uID, $uCostMetal, $uCostCrystal, $uCostDeuterium, $uCostEnergy, $uCostFactor);

            $this->level = $uLevel;
        }

        /**
         * Returns the metal-costs for the next level
         * @return float the metal-costs for the next level
         */
        public function getCostMetal() : float {
            return floor(parent::getCostMetal() * parent::getFactor() ** $this->level);
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

        /**
         * Returns the energy-costs for the next level
         * @return float the energy-costs for the next level
         */
        public function getCostEnergy() : float {
            return floor(parent::getCostEnergy() * pow(parent::getFactor(), $this->level));
        }

        /**
         * Returns the energy-consumption
         * @return float the energy-consumption
         */
        public function getEnergyConsumption($metPercent, $crystPercent, $deutPercent) : float {
//            global $data;

            // metal-mine
            if (parent::getUnitId() == 1) {
                return ceil(10 * $this->level * pow(1.1, $this->level) * ($metPercent / 100));
            }

            // crystal-mine
            if (parent::getUnitId() == 2) {
                return ceil(10 * $this->level * pow(1.1, $this->level) * ($crystPercent / 100));
            }

            // deuterium-mine
            if (parent::getUnitId() == 3) {
                return ceil(20 * $this->level * pow(1.1, $this->level) * ($deutPercent / 100));
            }

            return 0;
        }

        /**
         * Returns the current level
         * @return int the current level
         */
        public function getLevel() : int {
            return $this->level;
        }
    }