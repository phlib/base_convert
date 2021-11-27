<?php

namespace Phlib;

use PHPUnit\Framework\TestCase;

class BaseConvertTest extends TestCase
{
    public function testSmallConversionMatchesBuiltinFunction()
    {
        $number = 1234567890;
        static::assertEquals(\base_convert($number, 10, 36), \Phlib\base_convert($number, 10, 36));
    }

    public function testSmallConversionAsString()
    {
        $number = '1234567890';
        static::assertEquals(\base_convert($number, 10, 36), \Phlib\base_convert($number, 10, 36));
    }

    public function testLargeNumberConvertsBack()
    {
        $largeNumber = '111222333444555666777888999000';
        $base36 = \Phlib\base_convert($largeNumber, 10, 36);

        static::assertEquals($largeNumber, \Phlib\base_convert($base36, 36, 10));
    }

    public function testConverts10Correctly()
    {
        $largeNumber = '111222333444555666777888999000';
        $base10 = \Phlib\base_convert($largeNumber, 10, 10);

        static::assertEquals($largeNumber, $base10);
    }

    public function testConverts16Correctly()
    {
        $largeNumber = '111222333444555666777888999000';
        $hex = \Phlib\base_convert($largeNumber, 10, 16);

        static::assertEquals('16760f53979875a70ab1f4658', $hex);
        static::assertEquals($largeNumber, \Phlib\base_convert($hex, 16, 10));
    }

    public function testConverts36Correctly()
    {
        $largeNumber = '111222333444555666777888999000';
        $base36 = \Phlib\base_convert($largeNumber, 10, 36);

        static::assertEquals('as7078h9iolqwdhaw60', $base36);
        static::assertEquals($largeNumber, \Phlib\base_convert($base36, 36, 10));
    }
}
