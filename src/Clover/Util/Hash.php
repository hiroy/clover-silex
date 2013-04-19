<?php
namespace Clover\Util;

class Hash
{
    public static function validateWithSalt($string, $cryptString)
    {
        if (crypt($string, $cryptString) === $cryptString) {
            return true;
        }
        return false;
    }

    public static function cryptWithMd5($string)
    {
        if (!defined('CRYPT_MD5') || CRYPT_MD5 !== 1) {
            throw new \Exception('MD5 encryption is not supported.');
        }
        return crypt($string, self::createMd5SaltForCrypt());
    }

    public static function cryptWithBlowfish($string)
    {
        if (!defined('CRYPT_BLOWFISH') || CRYPT_BLOWFISH !== 1) {
            throw new \Exception('Blowfish encryption is not supported.');
        }
        return crypt($string, self::createBrowfishSaltForCrypt());
    }

    private static function createMd5SaltForCrypt()
    {
        $salt = '';
        $saltChars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
        for ($i = 0; $i < 8; $i++) {
            $salt .= $saltChars[array_rand($saltChars)];
        }
        return '$1$' . $salt . '$';
    }

    private static function createBrowfishSaltForCrypt($rounds = 7)
    {
        $salt = '';
        $saltChars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9), array('.', '/'));
        for ($i = 0; $i < 25; $i++) {
            $salt .= $saltChars[array_rand($saltChars)];
        }
        return sprintf('$2y$%02d$', $rounds) . $salt . '$';
    }
}
