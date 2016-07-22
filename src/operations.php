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
