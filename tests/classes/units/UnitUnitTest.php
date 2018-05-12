<?php

    declare(strict_types=1);

    if (!defined('INSIDE')) {
        define('INSIDE', true);
    }

//    require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/core/config.sample.php';

//    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/data/units.php";
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/units/unit.php";
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/units/research.php";

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
            $unit = new U_Research(13,1,1,1,1,1, 1.8);

            $this->assertSame(13, $unit->getUnitId());
            $this->assertSame(1.8, $unit->getFactor());


        }

    }
