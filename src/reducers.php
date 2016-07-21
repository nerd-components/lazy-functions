<?php

namespace KoteUtils\Lazy\Reducers;

/**
 * @param callable $func
 * @param mixed $initial
 * @param \Iterator $source
 * @return mixed
 */
function reduce(callable $func, $initial, \Iterator $source)
{
    $temp = $initial;

    foreach ($source as $item) {
        $temp = $func($item, $temp);
    }

    return $temp;
}

/**
 * Sends items to consumer.
 *
 * @param callable $consumer
 * @param \Iterator $source
 * @return void
 */
function consume(callable $consumer, \Iterator $source)
{
    foreach ($source as $item) {
        $consumer($item);
    }
}

/**
 * Converts generated sequence into array.
 *
 * @param \Iterator $source
 * @return array
 */
function toArray(\Iterator $source)
{
    return iterator_to_array($source);
}

/**
 * Converts generated sequence into string.
 *
 * @param \Iterator $source
 * @return string
 */
function toString(\Iterator $source)
{
    $str = '(';

    foreach ($source as $i => $item) {
        if ($i != 0) {
            $str .= ', ';
        }
        $str .= (string) $item;
    }

    return $str . ')';
}
