<?php

namespace Xelbot\Crypto\Utils;

use InvalidArgumentException;

/**
 * @see https://github.com/stephen-hill/base58php
 */
class Base58
{
    private static $alphabet = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';

    public static function decode($base58): string
    {
        $base = strlen(self::$alphabet);
        // Type Validation
        if (is_string($base58) === false) {
            throw new InvalidArgumentException('Argument $base58 must be a string.');
        }

        // If the string is empty, then the decoded string is obviously empty
        if (strlen($base58) === 0) {
            return '';
        }

        $indexes = array_flip(str_split(self::$alphabet));
        $chars = str_split($base58);

        // Check for invalid characters in the supplied base58 string
        foreach ($chars as $char) {
            if (isset($indexes[$char]) === false) {
                throw new InvalidArgumentException('Argument $base58 contains invalid characters. ($char: "' . $char . '" | $base58: "' . $base58 . '") ');
            }
        }

        // Convert from base58 to base10
        $decimal = $indexes[$chars[0]];

        for ($i = 1, $l = count($chars); $i < $l; $i++) {
            $decimal = bcmul($decimal, $base);
            $decimal = bcadd($decimal, $indexes[$chars[$i]]);
        }

        // Convert from base10 to base256 (8-bit byte array)
        $output = '';
        while ($decimal > 0) {
            $byte = (int)bcmod($decimal, 256);
            $output = pack('C', $byte) . $output;
            $decimal = bcdiv($decimal, 256, 0);
        }

        // Now we need to add leading zeros
        foreach ($chars as $char) {
            if ($indexes[$char] === 0) {
                $output = "\x00" . $output;
                continue;
            }
            break;
        }

        return $output;
    }

    /**
     * @see https://github.com/Merkeleon/php-cryptocurrency-address-validation/blob/master/src/Base58Validation.php
     */
    public static function toHex(string $base58): string
    {
        $origbase58 = $base58;

        $return = '0';
        for ($i = 0; $i < strlen($base58); $i++) {
            $current = (string)strpos(static::$alphabet, $base58[$i]);
            $return = bcmul($return, '58');
            $return = bcadd($return, $current);
        }

        $return = self::encodeHex($return);

        //leading zeros
        for ($i = 0; $i < strlen($origbase58) && $origbase58[$i] == static::$alphabet[0]; $i++) {
            $return = '00' . $return;
        }

        if (strlen($return) % 2 != 0) {
            $return = '0' . $return;
        }

        return $return;
    }

    /**
     * @see https://github.com/Merkeleon/php-cryptocurrency-address-validation/blob/master/src/Base58Validation.php
     */
    protected static function encodeHex(string $dec): string
    {
        $chars = '0123456789ABCDEF';
        $return = '';
        while (bccomp($dec, 0) == 1) {
            $dv = (string)bcdiv($dec, '16', 0);
            $rem = (int)bcmod($dec, '16');
            $dec = $dv;
            $return = $return . $chars[$rem];
        }

        return strrev($return);
    }
}
