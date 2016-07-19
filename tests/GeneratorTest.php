<?php

namespace Tests;

use KoteUtils\Lazy\Generators as G;
use KoteUtils\Lazy\Reducers as R;

class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testRangeGenerator()
    {
        $range = G\range(0, 9);

        $this->assertInstanceOf(\Generator::class, $range);

        $this->assertEquals([0, 1, 2, 3, 4, 5, 6, 7, 8, 9], R\toArray($range));
    }

    public function testRangeGeneratorWithCustomStep()
    {
        $range = G\range(0, 9, 3);

        $this->assertEquals([0, 3, 6, 9], R\toArray($range));
    }

    public function testRangeGeneratorException()
    {
        try {
            G\range(10, 0)->next();
            $this->fail('Start could not be bigger than end.');
        } catch (\InvalidArgumentException $exception) {
            /* No operation */
        }
        try {
            G\range(0, 1, -5)->next();
            $this->fail('Step could not be negative.');
        } catch (\InvalidArgumentException $exception) {
            /* No operation */
        }
    }

    public function testDoWhile()
    {
        $func = function ($value) {
            if ($value == 4) {
                return null;
            }
            return $value + 1;
        };

        $generator = G\doWhile($func, 0);

        $this->assertEquals([0, 1, 2, 3, 4], R\toArray($generator));
    }

    public function testMergeFunction()
    {
        $g1 = G\range(0, 5);
        $g2 = G\range(6, 10);

        $this->assertEquals(range(0, 10), R\toArray(G\merge($g1, $g2)));
    }
}
