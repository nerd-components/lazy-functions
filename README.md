# php-lazy
[![Build Status](https://travis-ci.org/pldin601/php-lazy.svg?branch=master)](https://travis-ci.org/pldin601/php-lazy)
[![Code Climate](https://codeclimate.com/github/pldin601/php-lazy/badges/gpa.svg)](https://codeclimate.com/github/pldin601/php-lazy)
[![Test Coverage](https://codeclimate.com/github/pldin601/php-lazy/badges/coverage.svg)](https://codeclimate.com/github/pldin601/php-lazy/coverage)
[![Issue Count](https://codeclimate.com/github/pldin601/php-lazy/badges/issue_count.svg)](https://codeclimate.com/github/pldin601/php-lazy)

[Documentation](http://github.com/pldin601/php-lazy/wiki/)

A set of functions that works with iterators and generators like with lazy arrays.

## Functions
```php
\RG\Lazy\Generators\range($from, $to, $step = 1): \Generator;
\RG\Lazy\Generators\produce(callable $producer, $initial = null): \Generator;
\RG\Lazy\Generators\merge(\Iterator ...$generators): \Generator;
\RG\Lazy\Generators\stream($fh, $buffer = STREAM_BUFFER_SIZE): \Generator;
\RG\Lazy\Generators\lines($fh): \Generator;

\RG\Lazy\Operations\map(callable $func, \Iterator $source): \Generator;
\RG\Lazy\Operations\filter(callable $func, \Iterator $source): \Generator;
\RG\Lazy\Operations\reject(callable $func, \Iterator $source): \Generator;
\RG\Lazy\Operations\take($amount, \Iterator $source): \Generator;
\RG\Lazy\Operations\skip($amount, \Iterator $source): \Generator;
\RG\Lazy\Operations\tail(\Iterator $source): \Generator;
\RG\Lazy\Operations\zipWith(callable $with, \Iterator $source1, \Iterator $source2): \Generator;
\RG\Lazy\Operations\zip(\Iterator $source1, \Iterator $source2): \Generator;

\RG\Lazy\Reducers\reduce(callable $func, $initial, \Iterator $source): mixed;
\RG\Lazy\Reducers\consume(callable $consumer, \Iterator $source): void;
\RG\Lazy\Reducers\toArray(\Iterator $source): array;
\RG\Lazy\Reducers\toString(\Iterator $source): string;
```
