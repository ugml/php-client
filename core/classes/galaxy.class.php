<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class Galaxy {

        private $debris_metal;

        private $debris_crystal;

        public function __construct(int $gdebris_metal, int $gdebris_crystal) {

            $this->debris_metal = $gdebris_metal;
            $this->debris_crystal = $gdebris_crystal;
        }

        public function printGalaxy() : void {

            echo '<pre>';
            print_r($this);
            echo '</pre>';
        }

        /**
         * @return mixed
         */
        public function getDebrisMetal() : int {

            return $this->debris_metal;
        }

        /**
         * @param mixed $debris_metal
         */
        public function setDebrisMetal($debris_metal) : void {

            $this->debris_metal = $debris_metal;
        }

        /**
         * @return mixed
         */
        public function getDebrisCrystal() : int {

            return $this->debris_crystal;
        }

        /**
         * @param mixed $debris_crystal
         */
        public function setDebrisCrystal($debris_crystal) : void {

            $this->debris_crystal = $debris_crystal;
        }

    }
