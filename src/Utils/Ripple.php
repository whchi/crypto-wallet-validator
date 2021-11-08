<?php

namespace Xelbot\Crypto\Utils;

use Lessmore92\BaseX\BaseX;

class Ripple
{
    protected const ALPHABETS = 'rpshnaf39wBUDNEGHJKLM4PQRST7VWXYZ2bcdeCg65jkm8oFqi1tuvAxyz';

    public static function verifyChecksum(string $address): bool
    {
        preg_match('/^r[' . self::ALPHABETS . ']{27,35}$/', $address, $matches);
        if (empty($matches)) {
            return false;
        }
        $basex = new BaseX(self::ALPHABETS);
        $decoded = $basex->decode($address);
        $computed = substr(hash('sha256', hash('sha256', substr($decoded->getBinary(), 0, -4), true), true), 0, 4);
        $checksum = substr($decoded->getBinary(), -4);

        return $computed === $checksum;
    }
}
