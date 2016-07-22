<?php

namespace Tests;

use KoteUtils\Lazy\Generators as G;
use KoteUtils\Lazy\Operations as O;
use KoteUtils\Lazy\Reducers as R;

class OperationTest extends \PHPUnit_Framework_TestCase
{
    private $generator;

    public function setUp()
    {
        $this->generator = G\range(0, 4);
    }

    public function testMap()
    {
        $map = function ($a) {
            return $a + 1;
        };

        $result = O\map($map, $this->generator);

        $this->assertEquals('(1, 2, 3, 4, 5)', R\toString($result));
    }

    public function testFilter()
    {
        $even = function ($a) {
            return $a % 2 == 0;
        };

        $result = O\filter($even, $this->generator);

        $this->assertEquals('(0, 2, 4)', R\toString($result));
    }

    public function testReject()
    {
        $even = function ($a) {
            return $a % 2 == 0;
        };

        $result = O\reject($even, $this->generator);

        $this->assertEquals('(1, 3)', R\toString($result));
    }

    public function testTake()
    {
        $result = O\take(2, $this->generator);

        $this->assertEquals('(0, 1)', R\toString($result));
    }

    public function testSkip()
    {
        $result = O\skip(2, $this->generator);

        $this->assertEquals('(2, 3, 4)', R\toString($result));
    }
}
