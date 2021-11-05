<?php

namespace Tests\Validators;

use Xelbot\Crypto\Validators\AddressValidatorInterface;
use Xelbot\Crypto\Validators\PolkadotValidator;

class PolkadotValidatorTest extends BaseAddressValidator
{
    protected $validAddresses = [
        '1iQPKJmghHbrRhUiMt2cNEuxYbR6S9vYtJKqYvE4PNR9WDB',
        '1FRMM8PEiWXYax7rpS6X4XZX1aAAxSWx1CrKTyrVYhV24fg',
        '5CK8D1sKNwF473wbuBP6NuhQfPaWUetNsWUNAAzVwTfxqjfr',
        'CpjsLDC1JFyrhm3ftC9Gs4QoyrkHKhZKtK7YqGTRFtTafgp',
        '15FKUKXC6kwaXxJ1tXNywmFy4ZY6FoDFCnU3fMbibFdeqwGw',
        'CxDDSH8gS7jecsxaRL9Txf8H5kqesLXAEAEgp76Yz632J9M',
    ];

    protected $invalidAddresses = [
        '1FRMM8PEiWXYax7rpS6X4XZX1aAAxSWx1CrKTyrVYhV24fh',
        '5CK8D1sKNwF473wbuBP6NuhQfPaWUetNsWUNAAzVwTfxqjf',
        'pjsLDC1JFyrhm3ftC9Gs4QoyrkHKhZKtK7YqGTRFtTafgp',
        '15FKUKXC6kwaXxJ1tNywmFy4ZY6FoDFCnU3fMbibFdeqwGw',
        'CxDDSH8gS7jecsxaRL8Txf8H5kqesLXAEAEgp76Yz632J9M',
    ];

    protected function createValidator(): AddressValidatorInterface
    {
        return new PolkadotValidator();
    }
}
