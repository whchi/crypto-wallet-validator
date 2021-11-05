<?php

namespace Xelbot\Crypto;

use Xelbot\Crypto\Exceptions\CurrencyNotFoundException;

class WalletValidatorFactory
{
    /**
     * @var array
     */
    protected static $currencies = [
        'ETH' => Validators\EthereumValidator::class,
        'UNI' => Validators\EthereumValidator::class,
        'AAVE' => Validators\EthereumValidator::class,
        'MATIC' => Validators\EthereumValidator::class,
        'MANA' => Validators\EthereumValidator::class,
        'BKX' => Validators\EthereumValidator::class,
        'CLO' => Validators\EthereumValidator::class,
        'ETC' => Validators\EthereumValidator::class,
        'ETZ' => Validators\EthereumValidator::class,
        'ZIL' => Validators\ZilliqaValidator::class,
        'DOT' => Validators\PolkadotValidator::class,
    ];

    /**
     * @throws CurrencyNotFoundException
     */
    public static function create(string $currency): Validators\AddressValidatorInterface
    {
        $currencyKey = strtoupper($currency);
        $class = self::$currencies[$currencyKey] ?? null;
        if (!$class) {
            throw new CurrencyNotFoundException(sprintf('Currency "%s" not found.', $currency));
        }

        return new $class();
    }
}
