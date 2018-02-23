<?php

    use PHPUnit\Framework\TestCase;

    define("INSIDE", true);

    require "../core/classes/data/userData.php";

    class UserDataTest extends TestCase {


        public function testGetUserID()
        {
            $user = new UserData(123, "testname", "email@mail.at", time(), 0);
            $this->assertSame(123, $user->getUserID());

        }

        public function testGetUsername() {
            $user = new UserData(123, "testname", "email@mail.at", time(), 0);
            $this->assertSame("testname", $user->getUsername());
        }

        public function testGetEmail() {
            $user = new UserData(123, "testname", "email@mail.at", time(), 0);
            $this->assertSame("email@mail.at", $user->getEmail());
        }

        public function testGetOnlineTime() {

            $ot = time();

            $user = new UserData(123, "testname", "email@mail.at", $ot, 0);
            $this->assertSame($ot, $user->getOnlineTime());
        }

        public function testGetCurrentPlanet() {
            $user = new UserData(123, "testname", "email@mail.at", time(), 0);
            $this->assertSame(0, $user->getCurrentPlanet());
        }

    }
