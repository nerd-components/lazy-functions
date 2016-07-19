# php-lazy
[![Build Status](https://travis-ci.org/pldin601/php-lazy.svg?branch=master)](https://travis-ci.org/pldin601/php-lazy)
[![Code Climate](https://codeclimate.com/github/pldin601/php-lazy/badges/gpa.svg)](https://codeclimate.com/github/pldin601/php-lazy)
[![Test Coverage](https://codeclimate.com/github/pldin601/php-lazy/badges/coverage.svg)](https://codeclimate.com/github/pldin601/php-lazy/coverage)
[![Issue Count](https://codeclimate.com/github/pldin601/php-lazy/badges/issue_count.svg)](https://codeclimate.com/github/pldin601/php-lazy)

A set of functions that works with iterators and generators like with lazy arrays.

## Lazy Generators
```php
use KoteUtils\Lazy\Generators as G;

$range = G\range(0, 6, 2); // Seq: 0, 2, 4, 6

$doWhile = G\doWhile(function ($previous) { // Seq: 0, 1, 2, 3, 4, 5
	return $previous > 5 ? null : $previous + 1;
}, 0);

$mergedGenerator = G\merge($range, $doWhile); // Seq: 0, 2, 4, 6, 0, 1, 2, 3, 4, 5
```
