<?php

    declare(strict_types=1);

    require_once __DIR__.'/config.php';


    require_once "core/classes/data/user.php";


    use PHPUnit\Framework\TestCase;

    final class UserDataTest extends TestCase {

        public function testGetUserID() : void {
            $user = new D_User(123, "testname", "email@mail.at", time(), 0, 0,0,0);
            $this->assertSame(123, $user->getUserID());

        }

        public function testGetUsername() : void {
            $user = new D_User(123, "testname", "email@mail.at", time(), 0, 0,0,0);
            $this->assertSame("testname", $user->getUsername());
        }

        public function testGetEmail() : void {
            $user = new D_User(123, "testname", "email@mail.at", time(), 0, 0,0,0);
            $this->assertSame("email@mail.at", $user->getEmail());
        }

        public function testGetOnlineTime() : void {

            $ot = time();

            $user = new D_User(123, "testname", "email@mail.at", $ot, 0, 0,0,0);
            $this->assertSame($ot, $user->getOnlineTime());
        }

        public function testGetCurrentPlanet() : void {
            $user = new D_User(123, "testname", "email@mail.at", time(), 0, 0,0,0);
            $this->assertSame(0, $user->getCurrentPlanet());
        }

    }
