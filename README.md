# phlib/base_convert

[![Build Status](https://img.shields.io/travis/phlib/base_convert/master.svg?style=flat-square)](https://travis-ci.org/phlib/base_convert)
[![Codecov](https://img.shields.io/codecov/c/github/phlib/base_convert.svg)](https://codecov.io/gh/phlib/base_convert)
[![Latest Stable Version](https://img.shields.io/packagist/v/phlib/base_convert.svg?style=flat-square)](https://packagist.org/packages/phlib/base_convert)
[![Total Downloads](https://img.shields.io/packagist/dt/phlib/base_convert.svg?style=flat-square)](https://packagist.org/packages/phlib/base_convert)
![Licence](https://img.shields.io/github/license/phlib/base_convert.svg)

Improvement to php `base_convert` function with support for large arbitrary number


## Install

Via Composer

``` bash
$ composer require phlib/base_convert
```

## Usage

Trying in php fails
``` php
// convert big number from base 10 to 36
$largeNumber = '111222333444555666777888999000';
$base36 = base_convert($largeNumber, 10, 36); // notice no error from php on the failure to convert
var_dump($base36);

// fails to convert back
var_dump($largeNumber == base_convert($base36, 36, 10));
```

Replace with phlib\base_convert and now it works
``` php
<?php
require_once 'vendor/autoload.php';

use function Phlib\base_convert;

// convert big number from base 10 to 36
$largeNumber = '111222333444555666777888999000';
$base36 = base_convert($largeNumber, 10, 36);
var_dump($base36);

// succesfully converts back
var_dump($largeNumber == base_convert($base36, 36, 10));
```

Making it clearer you're using a different function
``` php
require_once 'vendor/autoload.php';

// convert big number from base 10 to 36
$largeNumber = '111222333444555666777888999000';
$base36 = Phlib\base_convert($largeNumber, 10, 36);
var_dump($base36);

// succesfully converts back
var_dump($largeNumber == Phlib\base_convert($base36, 36, 10));
```

## License

This package is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
