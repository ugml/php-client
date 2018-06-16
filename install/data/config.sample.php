<?php


    defined('INSIDE') OR exit('No direct script access allowed');

    define('DEBUG', true);

    class Config_sample {

        public static $gameConfig;

        public static $dbConfig;

        public static $pathConfig;

        public static $debugModeEnabled;

        private static $basepath;

        private static $initialized = false;

        static function init() {

            // check, if already initialized
            if (self::$initialized) {
                return;
            }

            self::$initialized = true;

            self::$basepath = dirname(dirname(__FILE__)) . '/';


            self::$gameConfig = [
                'game_name'             => 'ugamela',
                'ugamela_version'       => "0.1.0-dev",
                'copyright'             => 'Copyright by ugamela &copy; 2017',
                'language'              => 'en',
                'max_galaxy'            => 9,
                'max_system'            => 100,
                'max_planet'            => 15,
                'base_income_metal'     => 500,
                'base_income_crystal'   => 250,
                'base_income_deuterium' => 0,
                'base_income_energy'    => 0,
                'skinpath'              => 'skins/Maya/'
            ];

            self::$dbConfig = [
                'host'   => 'DBHOST',
                'port'   => 'DBPORT',
                'dbname' => 'DBNAME',
                'user'   => 'DBUSER',
                'pass'   => 'DBPASS'
            ];

            self::$pathConfig = [
                'core'        => self::$basepath . 'core/',
                'interfaces'  => self::$basepath . 'core/interfaces/',
                'controllers' => self::$basepath . 'core/controllers/',
                'models'      => self::$basepath . 'core/models/',
                'views'       => self::$basepath . 'core/views/',
                'classes'     => self::$basepath . 'core/classes/',
                'data'        => self::$basepath . 'core/classes/data/',
                'units'       => self::$basepath . 'core/classes/units/',
                'language'    => self::$basepath . 'core/language/',
                'templates'   => self::$basepath . 'core/templates/'
            ];


        }
    }
