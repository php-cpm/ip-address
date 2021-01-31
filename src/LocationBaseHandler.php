<?php


namespace PhpCpm\IpAddress;


class LocationBaseHandler implements LocationHandlerInterface
{
    static $fullName = [];
    static $enName = [];

    public static function en2cn($string)
    {
        if (!$string) {
            return '';
        }

        $string = strtolower(trim($string));
        if (key_exists($string, static::$enName)) {
            $string = static::$enName[$string];
        }
        return $string;
    }

    public static function simple($string)
    {
        if (!$string) {
            return '';
        }
        $string = trim($string);
        if (key_exists($string, static::$fullName)) {
            $string = static::$fullName[$string];
        }
        return $string;
    }

    public static function convert($string)
    {
        return static::en2cn(static::simple($string));
    }
}