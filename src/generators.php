<?php

namespace RG\Lazy\Generators;

use function RG\Arrays\array_some;

const STREAM_BUFFER_SIZE = 4096;

/**
 * Returns generator with range of elements.
 *
 * @param int $start First value of the sequence.
 *
 * @param int $end The sequence is ended upon reaching end value.
 *
 * @param int $step If a step value is given, it will be used
 * as the increment between elements in the sequence. Step should be
 * given as a positive number. If not specified, step will default to 1.
 *
 * @return \Generator
 * @throws \InvalidArgumentException
 */
function range(int $start, int $end, int $step = 1): \Generator
{
    if ($step < 0) {
        throw new \InvalidArgumentException("Step could not be negative.");
    }

    for ($i = $start; $i <= $end; $i += $step) {
        yield $i;
    }
}

/**
 * Returns generator that calls $producer as long as it returns non-null value.
 * It can be used as infinity generator. As argument $producer receives result of previous
 * $producer's call. If $producer called for first time it receives $initial as argument.
 *
 * @param callable $producer Function that used to produce items.
 *
 * @param mixed $initial Optional value that will be used as the argument
 * when producing first item.
 *
 * @return \Generator
 */
function produce(callable $producer, $initial = null): \Generator
{
    while (!is_null($initial = $producer($initial))) {
        yield $initial;
    };
}

/**
 * Merges multiple iterators into one generator.
 *
 * @param \Iterator[] ...$iterators List of iterators that will be
 * merged into single generator.
 *
 * @return \Generator
 */
function merge(\Iterator ...$iterators): \Generator
{
    foreach ($iterators as $iterator) {
        foreach ($iterator as $item) {
            yield $item;
        }
    }
}

/**
 * @param \Iterator[] ...$iterators
 * @return \Generator
 */
function interlace(\Iterator ...$iterators): \Generator
{
    $isIteratorValid = function (\Iterator $iterator) {
        return $iterator->valid();
    };

    while (array_some($iterators, $isIteratorValid)) {
        foreach ($iterators as $iterator) {
            if ($iterator->valid()) {
                yield $iterator->current();
                $iterator->next();
            }
        }
    }
}

/**
 * Returns generator that reads raw data from stream.
 *
 * @param resource $fh File handle to read data from.
 *
 * @param int $buffer Buffer size which will be used when reading data.
 *
 * @return \Generator
 */
function stream($fh, $buffer = STREAM_BUFFER_SIZE): \Generator
{
    while ($data = fread($fh, $buffer)) {
        yield $data;
    }
}

/**
 * Returns generator that reads stream line by line.
 *
 * Notice: Each line is right trimmed.
 *
 * @param resource $fh File handle to read data from.
 *
 * @return \Generator
 */
function lines($fh): \Generator
{
    while ($line = fgets($fh)) {
        yield rtrim($line);
    }
}
