<?php
namespace Clover\Tests\Util;

use Clover\Util\Hash;

class HashTest extends \PHPUnit_Framework_TestCase
{
    public function testWithMd5()
    {
        $password = 'tpehjphgheheh';
        $storedPassword = Hash::cryptWithMd5($password);
        $this->assertTrue(Hash::validateWithSalt($password, $storedPassword));

        $illegalPassword = 'tpehjphghehea';
        $this->assertFalse(Hash::validateWithSalt($illegalPassword, $storedPassword));
    }

    public function testWithBlowfish()
    {
        $password = 'tpehjphgheheh';
        $storedPassword = Hash::cryptWithBlowfish($password);
        $this->assertTrue(Hash::validateWithSalt($password, $storedPassword));

        $illegalPassword = 'tpehjphghehea';
        $this->assertFalse(Hash::validateWithSalt($illegalPassword, $storedPassword));
    }
}
