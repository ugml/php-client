<?php

    namespace vendor\project\tests\units;

    require_once 'path/to/atoum.phar';

    include_once 'path/to/project/classes/helloWorld.php';

    use mageekguy\atoum;
    use vendor\project;

    class helloWorld extends atoum\test
    {
        public function testSay()
        {
            $helloWorld = new project\helloWorld();

            $this->string($helloWorld->say())->isEqualTo('Hello World!');
        }
    }