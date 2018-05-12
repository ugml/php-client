<?php

    declare(strict_types=1);

    if (!defined('INSIDE')) {
        define('INSIDE', true);
    }

//    require_once dirname(dirname(dirname(__FILE__))) . '/config.php';

//    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/data/units.php";
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/db.php";
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/units/unit.php";
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/core/classes/units/planet.php";

    use PHPUnit\Framework\TestCase;

    /**
     * Class UnitPlanetTest
     * @covers U_Planet::__construct
     * @codeCoverageIgnore
     */
    final class UnitPlanetTest extends TestCase {

        /**
         * @covers U_Unit::getCostMetal
         * @covers U_Defense::getCostMetal
         */
        public function testGetProjectInformation()
        {
            // Here, we create a mock prMysql object so we don't use the original
            $prMysql = $this->getMockBuilder(Database::class)
                ->disableOriginalConstructor()
                ->getMock();

            /* Here, we say that we expect a call to mysql_query with a given query,
             * and when we do, return a certain result.
             * You will also need to mock other methods as required */
            $expectedQuery = "SELECT product_id, projectName FROM test_projects
            WHERE projectId = 1";


            $returnValue = [['product_id' => 1, 'projectName' => 'test Name']];

            $prMysql->expects($this->once())
                ->method('prepare')
                ->with($this->equalTo($expectedQuery))
                ->willReturn($returnValue);

            // Here we call the method and do some checks on it
            $planet = new U_Planet(1,1,"Planet",1,1,1,1,1,"img.jpg", 1, 1,1,1,1,1.0,1.0,1.0,1,1,1,1,1,1,1,1,1,1,1,1,1,"",false,false);

            $result = $planet->update();
            $this->assertSame($returnValue, $result);
        }

    }
