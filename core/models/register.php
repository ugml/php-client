<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class M_Register implements I_Model {

        public function loadLanguage() {

            require Config::$pathConfig['language'] . Config::$gameConfig['language'] . '/register.php';

            return $lang;
        }

        /**
         * @param $username
         * @param $planetname
         * @param $email
         * @param $password
         * @return int 0 if success
         */
        public function createNewUser($username, $planetname, $email, $password) {

            $dbConnection = new Database();


            //--- user already exists? ---------------------------------------------------------------------------------
            $stmt = $dbConnection->prepare('SELECT userID FROM users WHERE username = :username OR email = :email;');

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);

            $stmt->execute();


            //if the username already exists
            if ($stmt->rowCount() > 0) {
                echo 'username or email already taken';

                return 1;
            }

            //------- generate random playerID ------------------------------------------------------------------------

            //check if ID is already taken
            do {
                $playerID = rand(0, 100000);

                $stmt = $dbConnection->prepare('SELECT userID FROM users WHERE userID= :userID;');

                $stmt->bindParam(':userID', $playerID);

                $stmt->execute();

            } while ($stmt->rowCount() > 0);


            //------- create the user ----------------------------------------------------------------------------------
            $stmt = $dbConnection->prepare('INSERT INTO users (userID, username, password, email, onlinetime, currentplanet) VALUES (:userID, :username, :password, :email, ' . time() . ', -1);');

            $password = password_hash($password, PASSWORD_DEFAULT);

            $stmt->bindParam(':userID', $playerID);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':email', $email);

            $stmt->execute();


            //------- create a planet ----------------------------------------------------------------------------------
            $planet = new U_Planet(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0);


            $planet->setOwnerID($playerID);
            $planet->setName("Planet");
            $planet->createPlanet(0);

            //            $planet->printPlanet();

            $stmt = $dbConnection->prepare('UPDATE users SET currentplanet = :currentplanet WHERE userID = :userID;');

            $planetID = $planet->getPlanetID();

            $stmt->bindParam(':currentplanet', $planetID);
            $stmt->bindParam(':userID', $playerID);

            $stmt->execute();

            // create galaxy-entry for the new planet
            $stmt = $dbConnection->prepare('INSERT INTO galaxy (planetID, debris_metal, debris_crystal) VALUES (:planetID, 0, 0);');
            $stmt->bindParam(':planetID', $planetID);
            $stmt->execute();

            // create buildings-entry for the new planet
            $stmt = $dbConnection->prepare('INSERT INTO buildings (`planetID`, `metal_mine`, `crystal_mine`, `deuterium_synthesizer`, `solar_plant`, `fusion_reactor`, `robotic_factory`, `nanite_factory`, `shipyard`, `metal_storage`, `crystal_storage`, `deuterium_storage`, `research_lab`, `terraformer`, `alliance_depot`, `missile_silo`) VALUES (:planetID, \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\')');
            $stmt->bindParam(':planetID', $planetID);
            $stmt->execute();

            // create defense-entry for the new planet
            $stmt = $dbConnection->prepare('INSERT INTO defenses (`planetID`, `rocket_launcher`, `light_laser`, `heavy_laser`, `ion_cannon`, `gauss_cannon`, `plasma_turret`, `small_shield_dome`, `large_shield_dome`, `anti_ballistic_missile`, `interplanetary_missile`) VALUES (:planetID, \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\')');
            $stmt->bindParam(':planetID', $planetID);
            $stmt->execute();

            // create fleet-entry for the new planet
            $stmt = $dbConnection->prepare('INSERT INTO fleet (`planetID`, `small_cargo_ship`, `large_cargo_ship`, `light_fighter`, `heavy_fighter`, `cruiser`, `battleship`, `colony_ship`, `recycler`, `espionage_probe`, `bomber`, `solar_satellite`, `destroyer`, `battlecruiser`, `deathstar`) VALUES (:planetID, \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\')');
            $stmt->bindParam(':planetID', $planetID);
            $stmt->execute();

            // create tech-entry for the new planet
            $stmt = $dbConnection->prepare('INSERT INTO techs (`userID`, `espionage_tech`, `computer_tech`, `weapon_tech`, `armour_tech`, `shielding_tech`, `energy_tech`, `hyperspace_tech`, `combustion_drive_tech`, `impulse_drive_tech`, `hyperspace_drive_tech`, `laser_tech`, `ion_tech`, `plasma_tech`, `intergalactic_research_tech`, `graviton_tech`) VALUES (:userID, \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\', \'0\')');
            $stmt->bindParam(':userID', $playerID);
            $stmt->execute();


            return 0;
        }
    }