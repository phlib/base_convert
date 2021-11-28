<?php

declare(strict_types=1);

namespace Phlib;

/**
 * Convert a large arbitrary number between arbitrary bases
 *
 * Works the same as the php version but supports large arbitrary numbers by using BCMath
 *
 * @see http://php.net/manual/en/function.base-convert.php
 * @see http://php.net/manual/en/function.base-convert.php#109660
 */
function base_convert(string $number, int $fromBase, int $toBase): string
{
    // Error messages to match original PHP function
    $baseOptions = [
        'options' => [
            'min_range' => 2,
            'max_range' => 36,
        ],
    ];
    if (filter_var($fromBase, FILTER_VALIDATE_INT, $baseOptions) === false) {
        throw new \InvalidArgumentException("Invalid `from base' ({$fromBase})");
    }
    if (filter_var($toBase, FILTER_VALIDATE_INT, $baseOptions) === false) {
        throw new \InvalidArgumentException("Invalid `to base' ({$toBase})");
    }

    if ($fromBase === $toBase) {
        return $number;
    }

    $number = trim($number);
    if ($fromBase !== 10) {
        $len = strlen($number);
        $fromDec = '0';
        for ($i = 0; $i < $len; $i++) {
            $v = \base_convert($number[$i], $fromBase, 10);
            $fromDec = bcadd(bcmul($fromDec, (string)$fromBase, 0), $v, 0);
        }
    } else {
        $fromDec = $number;
    }

    if ($toBase !== 10) {
        $result = '';
        while (bccomp($fromDec, '0', 0) > 0) {
            $v = (string)intval(bcmod($fromDec, (string)$toBase));
            $result = \base_convert($v, 10, $toBase) . $result;
            $fromDec = bcdiv($fromDec, (string)$toBase, 0);
        }
    } else {
        $result = $fromDec;
    }

    return $result;
}
