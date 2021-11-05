<?php

namespace Xelbot\Crypto\Validators;

interface AddressValidatorInterface
{
    public function validate(string $address): bool;
}
