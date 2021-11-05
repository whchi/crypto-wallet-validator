<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Xelbot\Crypto\Exceptions\CurrencyNotFoundException;
use Xelbot\Crypto\Validators\EthereumValidator;
use Xelbot\Crypto\Validators\PolkadotValidator;
use Xelbot\Crypto\Validators\ZilliqaValidator;
use Xelbot\Crypto\WalletValidatorFactory;

class WalletValidatorFactoryTest extends TestCase
{
    public function testUndefinedCurrency()
    {
        $this->expectException(CurrencyNotFoundException::class);
        $this->assertInstanceOf(EthereumValidator::class, WalletValidatorFactory::create('undefined'));
    }

    /**
     * @dataProvider ethFamily
     */
    public function testEthereumValidator(string $currency)
    {
        $this->assertInstanceOf(EthereumValidator::class, WalletValidatorFactory::create($currency));
    }

    public function testBankexValidator()
    {
        $this->assertInstanceOf(EthereumValidator::class, WalletValidatorFactory::create('BKX'));
        $this->assertInstanceOf(EthereumValidator::class, WalletValidatorFactory::create('bkx'));
        $this->assertInstanceOf(EthereumValidator::class, WalletValidatorFactory::create('Bkx'));
    }

    public function testCallistoValidator()
    {
        $this->assertInstanceOf(EthereumValidator::class, WalletValidatorFactory::create('CLO'));
        $this->assertInstanceOf(EthereumValidator::class, WalletValidatorFactory::create('clo'));
        $this->assertInstanceOf(EthereumValidator::class, WalletValidatorFactory::create('Clo'));
    }

    public function testEthereumClassicValidator()
    {
        $this->assertInstanceOf(EthereumValidator::class, WalletValidatorFactory::create('ETC'));
        $this->assertInstanceOf(EthereumValidator::class, WalletValidatorFactory::create('etc'));
        $this->assertInstanceOf(EthereumValidator::class, WalletValidatorFactory::create('Etc'));
    }

    public function testEthereumZeroValidator()
    {
        $this->assertInstanceOf(EthereumValidator::class, WalletValidatorFactory::create('ETZ'));
        $this->assertInstanceOf(EthereumValidator::class, WalletValidatorFactory::create('etz'));
        $this->assertInstanceOf(EthereumValidator::class, WalletValidatorFactory::create('Etz'));
    }

    public function testZilliqaValidator()
    {
        $this->assertInstanceOf(ZilliqaValidator::class, WalletValidatorFactory::create('ZIL'));
        $this->assertInstanceOf(ZilliqaValidator::class, WalletValidatorFactory::create('zil'));
    }

    public function testPolkadotValidator()
    {
        $this->assertInstanceOf(PolkadotValidator::class, WalletValidatorFactory::create('DOT'));
    }

    public function ethFamily(string $currency)
    {
        return [
            ['ETH'],
            ['UNI'],
            ['MANA'],
            ['AAVE'],
            ['MATIC'],
        ];
    }
}
