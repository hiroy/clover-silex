<?php
namespace Clover\Util;

class RandomString
{
    public static function generate($length)
    {
        $result = '';
        $chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[array_rand($chars)];
        }
        return $result;
    }
}
