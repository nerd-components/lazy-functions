<?php

namespace RG\Lazy\Operations;

/**
 * @param callable $func
 * @param \Iterator $source
 * @return \Generator
 */
function map(callable $func, \Iterator $source): \Generator
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
function filter(callable $func, \Iterator $source): \Generator
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
function reject(callable $func, \Iterator $source): \Generator
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
function take(int $amount, \Iterator $source): \Generator
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
function skip(int $amount, \Iterator $source): \Generator
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
 * Skips first generated item.
 *
 * @param \Iterator $source
 * @return \Generator
 */
function tail(\Iterator $source): \Generator
{
    return skip(1, $source);
}

/**
 * Calls the given function $with pairwise on each member of both iterators
 * and returns generator of call results. If one of iterators contains
 * more elements than other, null will be used as lacking element.
 *
 * @param callable $with
 * @param \Iterator $source1
 * @param \Iterator $source2
 * @return \Generator
 */
function zipWith(callable $with, \Iterator $source1, \Iterator $source2): \Generator
{
    while ($source1->valid() || $source2->valid()) {
        yield $with($source1->current(), $source2->current());

        $source1->next();
        $source2->next();
    }
}

/**
 * Returns generator of arrays, where each next array contains
 * each next element from each of the iterators.
 *
 * @param \Iterator $source1
 * @param \Iterator $source2
 * @return \Generator
 */
function zip(\Iterator $source1, \Iterator $source2): \Generator
{
    $with = function ($a, $b) {
        return [$a, $b];
    };

    return zipWith($with, $source1, $source2);
}
