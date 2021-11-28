<?php

declare(strict_types=1);

namespace Phlib;

use PHPUnit\Framework\TestCase;

class BaseConvertTest extends TestCase
{
    public function testSmallConversionMatchesBuiltinFunction(): void
    {
        $number = '1234567890';
        static::assertSame(\base_convert($number, 10, 36), \Phlib\base_convert($number, 10, 36));
    }

    /**
     * @dataProvider dataValidBase
     */
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

    /**
     * @dataProvider dataValidBase
     */
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

    public function dataValidBase(): array
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
