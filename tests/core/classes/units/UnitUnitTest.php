<?php

    declare(strict_types = 1);

    if (!defined('INSIDE')) {
        define('INSIDE', true);
    }

    use PHPUnit\Framework\TestCase;

    /**
     * Class UnitUnitTest
     * @covers U_Unit::__construct
     * @codeCoverageIgnore
     */
    final class UnitUnitTest extends TestCase {

        /**
         * @covers U_Unit::getUnitId
         * @covers U_Unit::getFactor
         */
        public function testUnitClass() : void {
            $unit = new U_Tech(13, 1, 1, 1, 1, 1, 1.8);

            $this->assertSame(13, $unit->getUnitId());
            $this->assertSame(1.8, $unit->getFactor());


        }

    }
