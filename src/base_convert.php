<?php

namespace Phlib;

/**
 * Convert a large arbitrary number between arbitrary bases
 *
 * Works the same as the php version but supports large arbitrary numbers by using BCMath
 *
 * @see http://php.net/manual/en/function.base-convert.php
 * @see http://php.net/manual/en/function.base-convert.php#109660
 */
function base_convert(string $number, int $frombase, int $tobase): string
{
    if ($frombase == $tobase) {
        return $number;
    }

    $number = trim($number);
    if ($frombase != 10) {
        $len = strlen($number);
        $fromDec = 0;
        for ($i = 0; $i < $len; $i++) {
            $v = \base_convert($number[$i], $frombase, 10);
            $fromDec = bcadd(bcmul($fromDec, $frombase, 0), $v, 0);
        }
    } else {
        $fromDec = $number;
    }

    if ($tobase != 10) {
        $result = '';
        while (bccomp($fromDec, '0', 0) > 0) {
            $v = intval(bcmod($fromDec, $tobase));
            $result = \base_convert($v, 10, $tobase) . $result;
            $fromDec = bcdiv($fromDec, $tobase, 0);
        }
    } else {
        $result = $fromDec;
    }

    return (string)$result;
}
