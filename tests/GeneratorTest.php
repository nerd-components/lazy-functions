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

        $this->assertEquals('(0, 1, 2, 3, 4, 5, 6, 7, 8, 9)', R\toString($range));
    }

    public function testRangeGeneratorWithCustomStep()
    {
        $range = G\range(0, 9, 3);

        $this->assertEquals('(0, 3, 6, 9)', R\toString($range));
    }

    public function testRangeGeneratorException()
    {
        try {
            G\range(10, 0)->valid();
            $this->fail('Start could not be bigger than end.');
        } catch (\InvalidArgumentException $exception) {
            /* No operation */
        }
        try {
            G\range(0, 1, -5)->valid();
            $this->fail('Step could not be negative.');
        } catch (\InvalidArgumentException $exception) {
            /* No operation */
        }
    }

    public function testMergeFunction()
    {
        $g1 = G\range(0, 5);
        $g2 = G\range(6, 10);

        $this->assertEquals('(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10)', R\toString(G\merge($g1, $g2)));
    }
    
    public function testStreamGenerator()
    {
        $handle = fopen(__DIR__.'/fixtures/stream.txt', 'r');
        $generator = G\stream($handle, 5);

        $this->assertEquals('Hello', $generator->current());
        $generator->next();

        $this->assertEquals('World', $generator->current());

        fclose($handle);
    }
}
