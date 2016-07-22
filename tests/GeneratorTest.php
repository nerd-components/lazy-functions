<?php

namespace Tests;

use KoteUtils\Lazy\Generators as G;
use KoteUtils\Lazy\Reducers as R;

class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testRangeGenerator()
    {
        $range = G\range(0, 4);

        $this->assertInstanceOf(\Generator::class, $range);

        $this->assertEquals('(0, 1, 2, 3, 4)', R\toString($range));
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
        $g1 = G\range(0, 2);
        $g2 = G\range(3, 5);
        $merged = G\merge($g1, $g2);

        $this->assertEquals('(0, 1, 2, 3, 4, 5)', R\toString($merged));
    }
    
    public function testStreamGenerator()
    {
        $fh = fopen(__DIR__.'/fixtures/stream.txt', 'r');

        $generator = G\stream($fh);

        $this->assertEquals('Hello, World!', $generator->current());

        fclose($fh);
    }

    public function testLinesGenerator()
    {
        $fh = fopen(__DIR__.'/fixtures/lines.txt', 'r');

        $generator = G\lines($fh);

        $this->assertEquals('foo', $generator->current());
        $generator->next();
        $this->assertEquals('bar', $generator->current());
        $generator->next();
        $this->assertEquals('baz', $generator->current());
        $generator->next();

        $this->assertFalse($generator->valid());

        fclose($fh);
    }
}
