<?php

namespace RG\Arrays;

/**
 * @param array $array
 * @param callable $callback
 * @return bool
 */
function array_some(array $array, callable $callback)
{
    foreach ($array as $item) {
        if ($callback($item)) {
            return true;
        }
    }
    return false;
}

/**
 * @param array $array
 * @param callable $callback
 * @return bool
 */
function array_every(array $array, callable $callback)
{
    foreach ($array as $item) {
        if (!$callback($item)) {
            return false;
        }
    }
    return true;
}
