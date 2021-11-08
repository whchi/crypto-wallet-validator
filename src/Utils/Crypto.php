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

    public static function sha256Checksum(string $payload)
    {
        $hash = hash('sha256', hash('sha256', $payload));

        return substr($hash, 0, 8);
//        print_r(self::byteArrayToHexStr($hash));
//        return substr(hash('sha256', hash('sha256', $payload)), 0, 8);
    }
}
