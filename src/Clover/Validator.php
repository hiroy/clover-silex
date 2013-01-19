<?php
namespace Clover;

class Validator
{
    public static function required($value)
    {
        return strlen($value) > 0;
    }

    public static function maxLength($value, $maxLength)
    {
        return mb_strlen($value) <= $maxLength;
    }

    public static function email($value)
    {
        return preg_match('/^[-_a-zA-Z0-9][-_\+a-zA-Z0-9\/.\?]*@[-a-zA-Z0-9.]+$/', $value);
    }
}
