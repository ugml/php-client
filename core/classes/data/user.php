<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    class Data_User {

        private $userID;

        private $username;

        private $email;

        private $onlineTime;

        private $currentPlanet;

        private $planetList = [];

        private $points;

        private $current_rank;

        private $old_rank;

        public function __construct(int $uID, string $uname, string $email, int $otime, int $currPlanet, int $points, int $cRank, int $oRank) {

            $this->userID = $uID;
            $this->username = $uname;
            $this->email = $email;
            $this->onlineTime = $otime;
            $this->currentPlanet = $currPlanet;
            $this->points = $points;
            $this->current_rank = $cRank;
            $this->old_rank = $oRank;
        }

        public function printUser() : void {

            echo '<pre>';
            print_r($this);
            echo '</pre>';
        }

        public function getUserID() : int {

            return $this->userID;
        }

        public function setUserID($userID) : void {

            $this->userID = $userID;
        }

        public function getUsername() : string {

            return $this->username;
        }

        public function setUsername($username) : void {

            $this->username = $username;
        }

        public function getEmail() : string {

            return $this->email;
        }

        public function setEmail($email) : void {

            $this->email = $email;
        }

        public function getOnlineTime() : int {

            return $this->onlineTime;
        }

        public function setOnlineTime($onlineTime) : void {

            $this->onlineTime = $onlineTime;
        }

        public function getCurrentPlanet() : int {

            return $this->currentPlanet;
        }

        public function setCurrentPlanet($cp) : void {

            global $database, $db;

            if ($cp == $this->currentPlanet) {
                return;
            }

            // check if the user really owns the planet
            for ($i = 0; $i < sizeof($this->planetList); $i++) {

                if ($this->planetList[$i]->getPlanetID() == $cp) {
                    // update the database
                    $query = 'UPDATE  ' . $database['prefix'] . 'users SET currentplanet = :cp WHERE  userID = :userID;';

                    $stmt = $db->prepare($query);

                    $stmt->bindParam(':cp', $cp);
                    $stmt->bindParam(':userID', $this->userID);

                    $stmt->execute();

                    // need to reload all the data, so refresh the page
                    header("Refresh:0");

                    break;
                }
            }
        }

        public function getPlanetList() : array {

            return $this->planetList;
        }

        public function setPlanetList(array $pList) : void {

            $this->planetList = $pList;
        }

        /**
         * @return mixed
         */
        public function getPoints() {
            return $this->points;
        }

        /**
         * @param mixed $points
         */
        public function setPoints($points) : void {
            $this->points = $points;
        }

        /**
         * @return mixed
         */
        public function getCurrentRank() {
            return $this->current_rank;
        }

        /**
         * @param mixed $current_rank
         */
        public function setCurrentRank($current_rank) : void {
            $this->current_rank = $current_rank;
        }

        /**
         * @return mixed
         */
        public function getOldRank() {
            return $this->old_rank;
        }

        /**
         * @param mixed $old_rank
         */
        public function setOldRank($old_rank) : void {
            $this->old_rank = $old_rank;
        }



    }
