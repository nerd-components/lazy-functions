<?php

namespace Nerd\Lazy\Reducers;

/**
 * Applies a function against an accumulator and each value of
 * the generator to reduce it to a single value.
 *
 * @param callable $func Callback function to execute on
 * each value in the array.
 *
 * @param mixed $initial Value to use as the first argument to the
 * first call of the callback.
 *
 * @param \Iterator $source The source reduce was called upon.
 *
 * @return mixed The value that results from the reduction.
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
 * Sends generated items to function-consumer.
 *
 * @param callable $consumer Callback function used to consume
 * generated items.
 *
 * @param \Iterator $source Source sequence of generated items.
 *
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
 * @param \Iterator $source Source sequence to convert into array.
 *
 * @return array Resulting array.
 */
function toArray(\Iterator $source)
{
    return iterator_to_array($source);
}

/**
 * Converts generated sequence into string.
 *
 * @param \Iterator $source Source sequence to convert into string.
 *
 * @return string Resulting string.
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
