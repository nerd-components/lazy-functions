<?php

namespace KoteUtils\Lazy\Generators;

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
 * Merges multiple generators into one generator.
 *
 * @param \Generator[] ...$generators
 * @return \Generator
 */
function merge(\Generator ...$generators)
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
 * @param resource $handle
 * @param int $buffer
 * @return \Generator
 */
function stream($handle, $buffer = 4096)
{
    while ($data = fread($handle, $buffer)) {
        yield $data;
    }
}

/**
 * Returns generator that reads stream line by line.
 *
 * @param $handle
 * @return \Generator
 */
function lines($handle)
{
    while ($line = fgets($handle)) {
        yield $line;
    }
}
