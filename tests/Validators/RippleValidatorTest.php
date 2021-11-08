<?php

namespace Tests\Validators;

use Xelbot\Crypto\Validators\AddressValidatorInterface;
use Xelbot\Crypto\Validators\RippleValidator;

class RippleValidatorTest extends BaseAddressValidator
{
    protected $validAddresses = [
        'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCn',
        'r3kmLJN5D28dHuH8vZNUZpMC43pEHpaocV',
        'rHb9CJAWyB4rj91VRWn96DkukG4bwdtyTh',
        'rDTXLQ7ZKZVKz33zJbHjgVShjsBnqMBhmN',
    ];

    protected $invalidAddresses = [
        'rG1QQv2nh2gr7RCZ1P8YYcBUKCCN633jCN',
        'rDTXLQ7ZKZVKz33zJbHjgVShjsBnqMBhMN',
        '6xAff4d6793F584a473348EbA058deb8ca',
        'DJ53hTyLBdZp2wMi5BsCS3rtEL1ioYUkva',
    ];

    protected function createValidator(): AddressValidatorInterface
    {
        return new RippleValidator();
    }
}
