<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    require $path['interfaces'] . 'model.interface.php';

    class M_Register implements I_Model {

        public static function loadLanguage() {

            global $path, $lang, $config;

            require $path['language'] . $config['language'] . '/register.language.php';

            return $lang;
        }

        /**
         * @param $username
         * @param $planetname
         * @param $email
         * @param $password
         * @return int 0 if success
         */
        public static function createNewUser($username, $planetname, $email, $password) {

            global $database, $path;

            require_once $path['classes'] . 'db.class.php';

            $db = new Database();


            //--- user already exists? ---------------------------------------------------------------------------------
            $stmt = $db->prepare('SELECT userID FROM ' . $database['prefix'] . 'users WHERE username = :username OR email = :email;');

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);

            $stmt->execute();


            //if the username already exists
            if ($stmt->rowCount() > 0) {
                echo 'username or email already taken';

                return 1;
            }

            //------- generate random playerID ------------------------------------------------------------------------
            $playerID = rand(0, 100000);

            //check if ID is already taken
            while ($db->query('SELECT userID FROM ' . $database['prefix'] . 'users WHERE userID=' . $playerID)
                    ->rowCount() > 0) {
                $playerID = rand(0, 100000);
            }

            //------- create the user ----------------------------------------------------------------------------------
            $stmt = $db->prepare('INSERT INTO ' . $database['prefix'] . 'users (userID, username, password, email, onlinetime, currentplanet) VALUES (:userID, :username, :password, :email, 0, -1);');

            $password = password_hash($password, PASSWORD_DEFAULT);

            $stmt->bindParam(':userID', $playerID);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':email', $email);

            $stmt->execute();

            //------- create a planet ----------------------------------------------------------------------------------
            require 'core/classes/planet.class.php';

            $planet = new Planet();


            $planet->setOwnerID($playerID);
            $planet->setName($planetname);
            $planet->createPlanet(1);

            $stmt = $db->prepare('UPDATE ' . $database['prefix'] . 'users SET currentplanet = :currentplanet WHERE userID = :userID;');

            $planetID = $planet->getPlanetID();

            $stmt->bindParam(':currentplanet', $planetID);
            $stmt->bindParam(':userID', $playerID);

            $stmt->execute();

            return 0;
        }

        public static function loadUserData($userID) {
        }
    }
