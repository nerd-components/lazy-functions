<?php

namespace Nerd\Lazy\Transformers;

/**
 * Applies the function to the elements of the given iterator.
 *
 * @param callable $func Function to be used to transform generating items.
 *
 * @param \Iterator $source Iterator to run through the function.
 *
 * @return \Generator
 */
function map(callable $func, \Iterator $source)
{
    foreach ($source as $i => $item) {
        yield $func($item, $i, $source);
    }
}

/**
 * Filters elements of an iterator using a callback function.
 *
 * @param callable $func The callback function to use.
 *
 * @param \Iterator $source The source to iterate over.
 *
 * @return \Generator
 */
function filter(callable $func, \Iterator $source)
{
    foreach ($source as $i => $item) {
        if ($func($item, $i, $source)) {
            yield $item;
        }
    }
}

/**
 * Rejects elements of an iterator using a callback function.
 *
 * @param callable $func The callback function to use.
 *
 * @param \Iterator $source The source to iterate over.
 *
 * @return \Generator
 */
function reject(callable $func, \Iterator $source)
{
    foreach ($source as $i => $item) {
        if (!$func($item, $i, $source)) {
            yield $item;
        }
    }
}

/**
 * Takes a few first generated items.
 *
 * @param int $amount How many items must be taken.
 *
 * @param \Iterator $source The source to take from.
 *
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
 * @param int $amount How many items must be skipped.
 *
 * @param \Iterator $source The source to iterate over.
 *
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
 * Skips first generated item.
 *
 * @param \Iterator $source The source to iterate over.
 *
 * @return \Generator
 */
function tail(\Iterator $source)
{
    return skip(1, $source);
}

/**
 * Calls the given function $with pairwise on each member of both iterators
 * and returns generator of call results. If one of iterators contains
 * more elements than other, null will be used as lacking element.
 *
 * @param callable $with Function used to merge zipping items.
 *
 * @param \Iterator $source1 First source.
 *
 * @param \Iterator $source2 Second source.
 *
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
 * Returns generator of arrays, where each next array contains
 * each next element from each of the iterators.
 *
 * @param \Iterator $source1 First source.
 *
 * @param \Iterator $source2 Second source.
 *
 * @return \Generator
 */
function zip(\Iterator $source1, \Iterator $source2)
{
    $with = function ($a, $b) {
        return [$a, $b];
    };

    return zipWith($with, $source1, $source2);
}
