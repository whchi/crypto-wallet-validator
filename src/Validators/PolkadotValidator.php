<?php

namespace Xelbot\Crypto\Validators;

use Xelbot\Crypto\Utils\Polkadot;

class PolkadotValidator implements AddressValidatorInterface
{
    public function validate(string $value): bool
    {
        return Polkadot::verifyChecksum($value);
    }
}
