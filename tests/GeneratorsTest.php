<?php

namespace Tests;

use RG\Lazy\Generators as G;
use RG\Lazy\Reducers as R;

class GeneratorsTest extends \PHPUnit_Framework_TestCase
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

    public function testInterlaceFunction()
    {
        $g1 = G\range(0, 2);
        $g2 = G\range(3, 5);
        $combined = G\interlace($g1, $g2);

        $this->assertEquals('(0, 3, 1, 4, 2, 5)', R\toString($combined));
    }
    
    public function testStreamGenerator()
    {
        $fh = fopen(__DIR__.'/fixtures/stream.txt', 'r');

        $generator = G\stream($fh);

        $this->assertEquals('Hello, World!', $generator->current());

        $generator->next();

        $this->assertFalse($generator->valid());

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

    public function testProducerGenerator()
    {
        $incremental = function ($prev) {
            return $prev > 4 ? null : $prev + 1;
        };

        $generator = G\produce($incremental, 0);

        $this->assertEquals('(1, 2, 3, 4, 5)', R\toString($generator));
    }
}
