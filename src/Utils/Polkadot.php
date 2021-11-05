<?php

namespace Xelbot\Crypto\Utils;

/**
 * @see https://github.com/christsim/multicoin-address-validator
 */
class Polkadot
{
    protected static $addressFormats = [
        ['addressLength' => 3, 'accountIndexLength' => 1, 'checkSumLength' => 1],
        ['addressLength' => 4, 'accountIndexLength' => 2, 'checkSumLength' => 1],
        ['addressLength' => 5, 'accountIndexLength' => 2, 'checkSumLength' => 2],
        ['addressLength' => 6, 'accountIndexLength' => 4, 'checkSumLength' => 1],
        ['addressLength' => 7, 'accountIndexLength' => 4, 'checkSumLength' => 2],
        ['addressLength' => 8, 'accountIndexLength' => 4, 'checkSumLength' => 3],
        ['addressLength' => 9, 'accountIndexLength' => 4, 'checkSumLength' => 4],
        ['addressLength' => 10, 'accountIndexLength' => 8, 'checkSumLength' => 1],
        ['addressLength' => 11, 'accountIndexLength' => 8, 'checkSumLength' => 2],
        ['addressLength' => 12, 'accountIndexLength' => 8, 'checkSumLength' => 3],
        ['addressLength' => 13, 'accountIndexLength' => 8, 'checkSumLength' => 4],
        ['addressLength' => 14, 'accountIndexLength' => 8, 'checkSumLength' => 5],
        ['addressLength' => 15, 'accountIndexLength' => 8, 'checkSumLength' => 6],
        ['addressLength' => 16, 'accountIndexLength' => 8, 'checkSumLength' => 7],
        ['addressLength' => 17, 'accountIndexLength' => 8, 'checkSumLength' => 8],
        ['addressLength' => 34, 'accountIndexLength' => 32, 'checkSumLength' => 2],
    ];

    /**
     * @throws \SodiumException
     */
    public static function verifyChecksum(string $address): bool
    {
        $preImage = '53533538505245';
        $decoded = Base58::decode($address);
        $bytesArray = unpack('C*', $decoded);

        $addressType = Crypto::byteArrayToHexStr(array_slice($bytesArray, 0, 1));

        $addressAndChecksum = array_slice($bytesArray, 1);

        $addressFormat = array_filter(self::$addressFormats, function ($item) use ($addressAndChecksum) {
            return $item['addressLength'] === count($addressAndChecksum);
        });
        if (!$addressFormat) {
            return false;
        }
        $addressFormat = array_pop($addressFormat);
        $decodedAddress = Crypto::byteArrayToHexStr(array_slice($addressAndChecksum, 0,
            $addressFormat['accountIndexLength']));
        $decodedAddress = strtoupper($decodedAddress);
        $checksum = Crypto::byteArrayToHexStr(array_slice($addressAndChecksum, (-$addressFormat['checkSumLength'])));
        $calculatedHash = Crypto::blake2b($preImage . $addressType . $decodedAddress,
            SODIUM_CRYPTO_GENERICHASH_BYTES_MAX);
        $calculatedHash = substr($calculatedHash, 0, $addressFormat['checkSumLength'] * 2);

        return $calculatedHash == $checksum;
    }
}
