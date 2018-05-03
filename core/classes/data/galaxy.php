<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    /**
     * This class maps the 'galaxy'-table to an php object.
     */
    class D_Galaxy {

        /** @var int Amount of Metal in the Debris */
        private $debris_metal;

        /** @var int Amount of Crystal in the Debris */
        private $debris_crystal;

        /**
         * D_Galaxy constructor.
         * @param int $gdebris_metal the amount of metal in the debris
         * @param int $gdebris_crystal the amount of crystal in the debris
         * @codeCoverageIgnore
         */
        public function __construct(int $gdebris_metal, int $gdebris_crystal) {
            $this->debris_metal = $gdebris_metal;
            $this->debris_crystal = $gdebris_crystal;
        }

        /**
         * Prints the object to the page
         * @codeCoverageIgnore
         */
        public function printGalaxy() : void {
            echo '<pre>';
            print_r($this);
            echo '</pre>';
        }

        /**
         * Returns the amount of metal in the debris
         * @return int the current amont
         */
        public function getDebrisMetal() : int {

            return $this->debris_metal;
        }

        /**
         * Sets the amount of metal in the debris
         * @param int metal in the debris
         */
        public function setDebrisMetal(int $debris_metal) : void {

            if($debris_metal >= 0) $this->debris_metal = $debris_metal;
        }

        /**
         * Returns the amount of crystal in the debris
         * @return int crystal in the debris
         */
        public function getDebrisCrystal() : int {

            return $this->debris_crystal;
        }

        /**
         * * Sets the amount of crystal in the debris
         * @param int crystal in the debris
         */
        public function setDebrisCrystal(int $debris_crystal) : void {

            if($debris_crystal >= 0) $this->debris_crystal = $debris_crystal;
        }

    }
