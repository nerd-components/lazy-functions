<?php

namespace KoteUtils\Lazy\Operators;

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
