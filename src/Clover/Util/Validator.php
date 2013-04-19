<?php
namespace Clover\Util;

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
        return preg_match('/^[-_a-zA-Z0-9][-_\+a-zA-Z0-9\/.\?]*@[-a-zA-Z0-9.]+$/', $value) === 1;
    }

    public static function date($year, $month, $day)
    {
        return checkdate($month, $day, $year);
    }

    public static function samePassword($password, $passwordConfirmation)
    {
        return ($password === $passwordConfirmation);
    }
}
