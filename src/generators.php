<?php

namespace RG\Lazy\Generators;

const STREAM_BUFFER_SIZE = 4096;

/**
 * Returns generator of integers with optional step.
 *
 * @param int $start
 * @param int $end
 * @param int $step
 * @return \Generator
 * @throws \InvalidArgumentException
 */
function range($start, $end, $step = 1)
{
    if ($step < 0) {
        throw new \InvalidArgumentException("Step could not be negative.");
    }
    if ($start > $end) {
        throw new \InvalidArgumentException("Start could not be greater than end.");
    }
    for ($i = $start; $i <= $end; $i += $step) {
        yield $i;
    }
}

/**
 * Returns generator that calls $producer as long as it returns non-null value.
 * It can be used as infinity generator. As argument $producer receives result
 * of previous call. If $producer called first time it receives $initial as argument.
 *
 * @param callable $producer
 * @param null $initial
 * @return \Generator
 */
function produce(callable $producer, $initial = null)
{
    while (!is_null($initial = $producer($initial))) {
        yield $initial;
    };
}

/**
 * Merges multiple iterators into one generator.
 *
 * @param \Iterator[] ...$generators
 * @return \Generator
 */
function merge(\Iterator ...$generators)
{
    foreach ($generators as $generator) {
        foreach ($generator as $item) {
            yield $item;
        }
    }
}

/**
 * Returns generator that reads raw data from stream.
 *
 * @param resource $fh
 * @param int $buffer
 * @return \Generator
 */
function stream($fh, $buffer = STREAM_BUFFER_SIZE)
{
    while ($data = fread($fh, $buffer)) {
        yield $data;
    }
}

/**
 * Returns generator that reads stream line by line.
 *
 * @param $fh
 * @return \Generator
 */
function lines($fh)
{
    while ($line = fgets($fh)) {
        yield rtrim($line);
    }
}
