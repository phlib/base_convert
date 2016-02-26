# phlib/base_convert

[![Build Status](https://img.shields.io/travis/phlib/convert/master.svg?style=flat-square)](https://travis-ci.org/phlib/base_convert)
[![Latest Stable Version](https://img.shields.io/packagist/v/phlib/convert.svg?style=flat-square)](https://packagist.org/packages/phlib/base_convert)
[![Total Downloads](https://img.shields.io/packagist/dt/phlib/convert.svg?style=flat-square)](https://packagist.org/packages/phlib/base_convert)

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

