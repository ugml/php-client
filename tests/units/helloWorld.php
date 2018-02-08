<?php

    namespace tests\units;

//    require_once 'vendor/bin/atoum.phar';

    include_once 'core/classes/user.class.php';

    use mageekguy\atoum;
    use core\classes;

    class userTests extends atoum\test
    {

        public function testGetUserID()
        {
            $user = new User(123, "testname", "email@mail.at", time(), 0);
            $this->integer($user->getUserID())->isEqualTo(123);

        }

        public function testGetUsername() {
            $user = new User(123, "testname", "email@mail.at", time(), 0);
            $this->string($user->getUsername())->isEqualTo("testname");
        }

        public function testGetEmail() {
            $user = new User(123, "testname", "email@mail.at", time(), 0);
            $this->string($user->getEmail())->isEqualTo("email@mail.at");
        }

        public function testGetOnlineTime() {

            $ot = time();

            $user = new User(123, "testname", "email@mail.at", $ot, 0);
            $this->string($user->getOnlineTime())->isEqualTo($ot);
        }

        public function testGetCurrentPlanet() {
            $user = new User(123, "testname", "email@mail.at", time(), 0);
            $this->string($user->getCurrentPlanet())->isEqualTo(0);
        }


    }