<?php

declare(strict_types=1);

namespace Xelbot\Crypto\Utils;

class Crypto
{
    public static function byteArrayToHexStr(array $array): string
    {
        $chars = array_map('chr', $array);
        $bin = join($chars);

        return bin2hex($bin);
    }

    /**
     * @throws \SodiumException
     */
    public static function blake2b(string $hex, int $len): string
    {
        $hex = pack('H*', $hex);

        return sodium_bin2hex(sodium_crypto_generichash($hex, '', $len));
    }
}
