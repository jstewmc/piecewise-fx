# piecewise-fx
Piecewise math functions.

```php
use Jstewmc\Fx\{Constant, Linear}
use Jstewmc\Interval\Interval;
use Jstewmc\PiecewiseFx;

// define our sub-functions...
//     y = 1     | 0 <= x <= 3
//     y = x - 2 | 3 < x <= 6
//     y = 4     | 6 < x <= 9
//
$subFxs = [
    new SubFx(
        new Interval('[1, 3]'),
        new Constant(1)
    ),
    new SubFx(
        new Interval('(3, 6]'),
        new Linear(1, -2)
    ),
    new SubFx(
        new Interval('(6, 9]'),
        new Constant(4)
    )
];

// define our piecewise fx
$fx = new PiecewiseFx($subFxs);

$fx(1);  // returns 1
$fx(2);  // returns 1
$fx(3);  // returns 1
$fx(4);  // returns 2
$fx(5);  // returns 3 
$fx(6);  // returns 4
$fx(7);  // returns 4
$fx(8);  // returns 4
$fx(9);  // returns 4
```

A [piecewise function](https://en.wikipedia.org/wiki/Piecewise) is a function composed of multiple sub-functions, where each sub-function applies to an interval of the function's domain. 

This library relies heavily on [jstewmc/fx](https://github.com/jstewmc/fx) and [jstewmc/interval](https://github.com/jstewmc/interval).

A piecewise function requires an array of sub-functions. Each sub-function, in turn, requires an interval and function.

## License

[MIT](https://github.com/jstewmc/piecewise-fx/blob/master/LICENSE)

## Author

[Jack Clayton](mailto:clayjs0@gmail.com)

## Version

### 0.1.0, August 6, 2016

* Initial release


