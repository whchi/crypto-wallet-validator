<?php

namespace Xelbot\Crypto\Validators;

use Xelbot\Crypto\Utils\Ripple;

class RippleValidator implements AddressValidatorInterface
{
    public function validate(string $value): bool
    {
        return Ripple::verifyChecksum($value);
    }
}
