<?php

namespace KoteUtils\Lazy\Operations;

/**
 * @param callable $func
 * @param \Iterator $source
 * @return \Generator
 */
function map(callable $func, \Iterator $source)
{
    foreach ($source as $item) {
        yield $func($item);
    }
}

/**
 * @param callable $func
 * @param \Iterator $source
 * @return \Generator
 */
function filter(callable $func, \Iterator $source)
{
    foreach ($source as $item) {
        if ($func($item)) {
            yield $item;
        }
    }
}

/**
 * @param callable $func
 * @param \Iterator $source
 * @return \Generator
 */
function reject(callable $func, \Iterator $source)
{
    foreach ($source as $item) {
        if (!$func($item)) {
            yield $item;
        }
    }
}

/**
 * Takes a few first generated items.
 *
 * @param int $amount
 * @param \Iterator $source
 * @return \Generator
 */
function take($amount, \Iterator $source)
{
    foreach ($source as $item) {
        if ($amount <= 0) {
            break;
        }
        $amount --;

        yield $item;
    }
}

/**
 * Skips a few first generated items.
 *
 * @param int $amount
 * @param \Iterator $source
 * @return \Generator
 */
function skip($amount, \Iterator $source)
{
    foreach ($source as $item) {
        if ($amount > 0) {
            $amount --;
            continue;
        }

        yield $item;
    }
}

/**
 * @param callable $with
 * @param \Iterator $source1
 * @param \Iterator $source2
 * @return \Generator
 */
function zipWith(callable $with, \Iterator $source1, \Iterator $source2)
{
    while ($source1->valid() || $source2->valid()) {
        yield $with($source1->current(), $source2->current());
        $source1->next();
        $source2->next();
    }
}

/**
 * @param \Iterator $source1
 * @param \Iterator $source2
 * @return \Generator
 */
function zip(\Iterator $source1, \Iterator $source2)
{
    $with = function ($a, $b) { return [$a, $b]; };

    return zipWith($with, $source1, $source2);
}