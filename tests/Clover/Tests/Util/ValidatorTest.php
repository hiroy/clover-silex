<?php
namespace Clover\Tests\Util;

use Clover\Util\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testRequired()
    {
        $this->assertTrue(Validator::required('a'));
        $this->assertTrue(Validator::required('0'));
        $this->assertTrue(Validator::required(' '));
        $this->assertTrue(Validator::required('false'));
        $this->assertTrue(Validator::required('null'));

        $this->assertFalse(Validator::required(''));
        $this->assertFalse(Validator::required(null));
    }

    public function testMaxLength()
    {
        $this->assertTrue(Validator::maxLength('aa', 3));
        $this->assertTrue(Validator::maxLength('aa', 2));
        $this->assertFalse(Validator::maxLength('aa', 1));
    }

    public function testEmail()
    {
        $this->assertTrue(Validator::email('test@example.com'));
        $this->assertTrue(Validator::email('te.st@example.com'));
        $this->assertTrue(Validator::email('t-e-s-t@example.com'));
        $this->assertTrue(Validator::email('test+1@example.com'));
        $this->assertTrue(Validator::email('-test+1@example.com'));
        $this->assertTrue(Validator::email('tes/t@example.com'));

        $this->assertFalse(Validator::email('@test@example.com'));
        $this->assertFalse(Validator::email('test_at_example.com'));
    }

    public function testDate()
    {
        $this->assertTrue(Validator::date(2013, 4, 19));
        $this->assertTrue(Validator::date(2013, 4, 30));
        $this->assertTrue(Validator::date(2012, 2, 29));

        $this->assertFalse(Validator::date(2013, 4, 31));
        $this->assertFalse(Validator::date(2013, 2, 29));
    }

    public function testSamePassword()
    {
        $this->assertTrue(Validator::samePassword('a', 'a'));
        $this->assertTrue(Validator::samePassword('tomato', 'tomato'));

        $this->assertFalse(Validator::samePassword('tomato', 'tomat'));
        $this->assertFalse(Validator::samePassword(' ', '0'));
    }
}
