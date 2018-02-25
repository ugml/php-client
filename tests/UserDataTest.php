<?php

    require_once __DIR__.'/config.php';


    require_once "core/classes/data/user.php";

    class UserDataTest extends PHPUnit_Framework_TestCase {

        public function testGetUserID() {
            $user = new Data_User(123, "testname", "email@mail.at", time(), 0, 0,0,0);
            $this->assertSame(123, $user->getUserID());

        }

        public function testGetUsername() {
            $user = new Data_User(123, "testname", "email@mail.at", time(), 0, 0,0,0);
            $this->assertSame("testname", $user->getUsername());
        }

        public function testGetEmail() {
            $user = new Data_User(123, "testname", "email@mail.at", time(), 0, 0,0,0);
            $this->assertSame("email@mail.at", $user->getEmail());
        }

        public function testGetOnlineTime() {

            $ot = time();

            $user = new Data_User(123, "testname", "email@mail.at", $ot, 0, 0,0,0);
            $this->assertSame($ot, $user->getOnlineTime());
        }

        public function testGetCurrentPlanet() {
            $user = new Data_User(123, "testname", "email@mail.at", time(), 0, 0,0,0);
            $this->assertSame(0, $user->getCurrentPlanet());
        }

    }
