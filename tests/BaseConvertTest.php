<?php

declare(strict_types=1);

namespace Phlib;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class BaseConvertTest extends TestCase
{
    public function testSmallConversionMatchesBuiltinFunction(): void
    {
        $number = '1234567890';
        static::assertSame(\base_convert($number, 10, 36), \Phlib\base_convert($number, 10, 36));
    }

    #[DataProvider('dataValidNumberCharacters')]
    public function testValidNumberCharacters(string $number, bool $isValid): void
    {
        if (!$isValid) {
            $this->expectException(\InvalidArgumentException::class);
            $this->expectExceptionMessage('Invalid characters passed for attempted conversion');
        }

        \Phlib\base_convert($number, 36, 10);

        if ($isValid) {
            // Valid number should reach this line without error
            static::assertTrue(true);
        }
    }

    public static function dataValidNumberCharacters(): array
    {
        return [
            'numeric' => ['123', true],
            'alphanumeric' => ['123abc', true],
            'float' => ['3.6', false],
            'scientific' => ['1.2e3', false],
        ];
    }

    public function testOriginalNumberCharactersWarning(): void
    {
        /**
         * PHP's own validation for `$number` is more accurate
         * as it warns against characters that are not allowed by the given from base,
         * e.g. *base2* only allows *0* and *1*.
         */
        $originalErrorLevel = error_reporting();
        error_reporting(E_ALL);

        set_error_handler(static function (int $errno, string $errstr): never {
            throw new \Exception($errstr, $errno);
        }, E_DEPRECATED);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid characters passed for attempted conversion, these have been ignored');

        try {
            \Phlib\base_convert('123', 2, 10);
        } finally {
            error_reporting($originalErrorLevel);
            restore_error_handler();
        }
    }

    #[DataProvider('dataValidBase')]
    public function testValidFromBase(int $fromBase, bool $isValid): void
    {
        if (!$isValid) {
            $this->expectException(\InvalidArgumentException::class);
            $this->expectExceptionMessage("Invalid `from base' ({$fromBase})");
        }

        \Phlib\base_convert('1', $fromBase, 10);

        if ($isValid) {
            // Valid base should reach this line without error
            static::assertTrue(true);
        }
    }

    #[DataProvider('dataValidBase')]
    public function testValidToBase(int $toBase, bool $isValid): void
    {
        if (!$isValid) {
            $this->expectException(\InvalidArgumentException::class);
            $this->expectExceptionMessage("Invalid `to base' ({$toBase})");
        }

        \Phlib\base_convert('1', 10, $toBase);

        if ($isValid) {
            // Valid base should reach this line without error
            static::assertTrue(true);
        }
    }

    public static function dataValidBase(): array
    {
        return [
            'too-small' => [1, false],
            'min' => [2, true],
            'max' => [36, true],
            'too-large' => [37, false],
        ];
    }

    public function testLargeNumberConvertsBack(): void
    {
        $largeNumber = '111222333444555666777888999000';
        $base36 = \Phlib\base_convert($largeNumber, 10, 36);

        static::assertSame($largeNumber, \Phlib\base_convert($base36, 36, 10));
    }

    public function testConverts10Correctly(): void
    {
        $largeNumber = '111222333444555666777888999000';
        $base10 = \Phlib\base_convert($largeNumber, 10, 10);

        static::assertSame($largeNumber, $base10);
    }

    public function testConverts16Correctly(): void
    {
        $largeNumber = '111222333444555666777888999000';
        $hex = \Phlib\base_convert($largeNumber, 10, 16);

        static::assertSame('16760f53979875a70ab1f4658', $hex);
        static::assertSame($largeNumber, \Phlib\base_convert($hex, 16, 10));
    }

    public function testConverts36Correctly(): void
    {
        $largeNumber = '111222333444555666777888999000';
        $base36 = \Phlib\base_convert($largeNumber, 10, 36);

        static::assertSame('as7078h9iolqwdhaw60', $base36);
        static::assertSame($largeNumber, \Phlib\base_convert($base36, 36, 10));
    }
}
