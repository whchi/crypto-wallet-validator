<?php

namespace Xelbot\Crypto;

class WalletValidator
{
    public static function validate(string $address, string $currency): bool
    {
        $validator = WalletValidatorFactory::create($currency);

        return $validator->validate($address);
    }
}
