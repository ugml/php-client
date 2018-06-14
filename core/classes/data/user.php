<?php

    declare(strict_types = 1);

    defined('INSIDE') OR exit('No direct script access allowed');

    /**
     * This class maps the 'user'-table to an php object and is also responsible of keeping it up-to-date.
     *
     */
    class D_User implements JsonSerializable {

        private $userID;

        private $username;

        private $email;

        private $onlineTime;

        private $currentPlanet;

        private $planetList = [];

        private $points;

        private $current_rank;

        private $old_rank;

        /**
         * D_User constructor.
         * @param int    $uID
         * @param string $uname
         * @param string $email
         * @param int    $otime
         * @param int    $currPlanet
         * @param int    $points
         * @param int    $cRank
         * @param int    $oRank
         */
        public function __construct(int $uID, string $uname, string $email, int $otime, int $currPlanet, int $points,
            int $cRank, int $oRank) {

            $this->userID = $uID;
            $this->username = $uname;
            $this->email = $email;
            $this->onlineTime = $otime;
            $this->currentPlanet = $currPlanet;
            $this->points = $points;
            $this->current_rank = $cRank;
            $this->old_rank = $oRank;
        }

        /**
         * @codeCoverageIgnore
         */
        public function print() : void {

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

        public function setCurrentPlanet(int $cp) : void {

            if (intval($cp) == $this->currentPlanet) {
                return;
            }

            // TODO: relocate this code
            // check if the user really owns the planet
            for ($i = 0; $i < sizeof($this->planetList); $i++) {

                if ($this->planetList[$i]->getPlanetID() == $cp) {
                    // update the database
                    $query = 'UPDATE  users SET currentplanet = :cp WHERE  userID = :userID;';

                    $dbConnection = new Database();

                    $stmt = $dbConnection->prepare($query);

                    $stmt->bindParam(':cp', $cp);
                    $stmt->bindParam(':userID', $this->userID);

                    $stmt->execute();

                    $this->currentPlanet = intval($cp);

                    // need to reload all the data, so refresh the page
                    //header("Refresh:0");
                    // TODO: return value to caller who then will refresh the page

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

        public function jsonSerialize() {
            return get_object_vars($this);
        }

    }
