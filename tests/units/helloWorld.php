<?php

    namespace vendor\project\tests\units;

//    require_once 'vendor/bin/atoum.phar';

    //include_once 'path/to/project/classes/helloWorld.php';

    use mageekguy\atoum;
    use core\classes;

    class user.class extends atoum\test
    {
        public function testSay()
        {
            $helloWorld = "Hello World!";

            $this->string($helloWorld)->isEqualTo("Hello World!");
        }
    }