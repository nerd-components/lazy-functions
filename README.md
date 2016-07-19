# php-lazy
[![Build Status](https://travis-ci.org/pldin601/php-lazy.svg?branch=master)](https://travis-ci.org/pldin601/php-lazy)
[![Code Climate](https://codeclimate.com/github/pldin601/php-lazy/badges/gpa.svg)](https://codeclimate.com/github/pldin601/php-lazy)
[![Test Coverage](https://codeclimate.com/github/pldin601/php-lazy/badges/coverage.svg)](https://codeclimate.com/github/pldin601/php-lazy/coverage)
[![Issue Count](https://codeclimate.com/github/pldin601/php-lazy/badges/issue_count.svg)](https://codeclimate.com/github/pldin601/php-lazy)

A set of functions that works with iterators and generators like with lazy arrays.

## Lazy Generators
```php
use KoteUtils\Lazy\Generators as G;

// Range Generators
$range1 = G\range(0, 6, 2);
$range2 = G\range(1, 5, 1);

// Merge Multiple Generators
$range = G\merge($range1, $range2);
```
