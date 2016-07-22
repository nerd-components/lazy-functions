<?php

namespace tests;

use KoteUtils\Lazy\Generators as G;
use KoteUtils\Lazy\Reducers as R;

class ReducersTest extends \PHPUnit_Framework_TestCase
{
    private $generator;

    public function setUp()
    {
        $this->generator = G\range(0, 4);
    }

    public function testToString()
    {
        $this->assertEquals('(0, 1, 2, 3, 4)', R\toString($this->generator));
    }

    public function testToArray()
    {
        $this->assertEquals([0, 1, 2, 3, 4], R\toArray($this->generator));
    }

    public function testReduce()
    {
        $result = R\reduce(function ($a, $b) {
            return $a + $b;
        }, 0, $this->generator);

        $this->assertEquals(10, $result);
    }


}
