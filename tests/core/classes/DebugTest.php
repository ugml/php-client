<?php

    declare(strict_types = 1);

    use PHPUnit\Framework\TestCase;

    /**
     * Class DebugTest
     * @covers Debug::__construct
     * @codeCoverageIgnore
     */
    final class DebugTest extends TestCase {

        private $debug;

        /**
         * @covers Debug::__construct
         */
        protected function setUp() : void {
            $this->debug = new Debug();
            $this->assertSame(0, $this->debug->getCount());
        }

        /**
         * @covers Debug::getCount
         */
        public function testLogCount() : void {
            $this->assertSame(0, $this->debug->getCount());
        }

        /**
         * @covers Debug::addLog
         */
        public function testAddLog() {

            $this->assertSame(0, $this->debug->getCount());

            //$class, $method, $line, $exception, $descr
            $this->debug->addLog("Debug", "sampleMethod", "12", "NoException", "NoDescription");

            $this->assertSame(1, $this->debug->getCount());
        }

        /**
         * @covers Debug::saveError
         */
        public function testSaveError() {

            $dbConnection = new Database();

            $stmt = $dbConnection->prepare('SELECT count(id) FROM ' . Config::$dbConfig['prefix'] . 'errors');

            $stmt->execute();

            $countOld = $stmt->fetchColumn(0);

            $this->assertSame(0, intval($countOld));

            $this->debug->saveError(self::class, "", "", "", "");

            $stmt = $dbConnection->prepare('SELECT count(id) FROM ' . Config::$dbConfig['prefix'] . 'errors');

            $stmt->execute();

            $countNew = $stmt->fetchColumn(0);

            $this->assertSame(1, intval($countNew));

        }

        protected function tearDown()
        {
            $dbConnection = new Database();

            $stmt = $dbConnection->prepare('TRUNCATE ' . Config::$dbConfig['prefix'] . 'errors');

            $stmt->execute();

            $this->debug = null;
        }

    }
