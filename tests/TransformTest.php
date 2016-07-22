<?php

namespace Tests;

use KoteUtils\Lazy\Operations as O;
use KoteUtils\Lazy\Reducers as R;

class TransformTest extends \PHPUnit_Framework_TestCase
{
    public function testMapFunction()
    {
        $result = O\map(function ($a) {
            return $a * 10;
        }, $this->generator());

        $this->assertEquals(range(0, 90, 10), R\toArray($result));
    }

    public function testFilterFunction()
    {
        $result = O\filter(function ($a) {
            return $a > 5;
        }, $this->generator());

        $this->assertEquals(range(6, 9), R\toArray($result));
    }

    public function testRejectFunction()
    {
        $result = O\reject(function ($a) {
            return $a > 5;
        }, $this->generator());

        $this->assertEquals(range(0, 5), R\toArray($result));
    }

    public function testReduceFunction()
    {
        $result = R\reduce(function ($a, $b) {
            return $a + $b;
        }, 0, $this->generator());

        $this->assertEquals(45, $result);
    }

    /**
     * @return \Generator
     */
    public function generator()
    {
        for ($i = 0; $i < 10; $i ++) {
            yield $i;
        }
    }
}
