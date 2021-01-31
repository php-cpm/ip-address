<?php


namespace PhpCpm\IpAddress;


class WorldProvince
{
    public static $classMap = [
        '中国' => ChinaProvince::class,
        '美国' => USAProvince::class,
    ];

    public static function convert($country, $string)
    {
        if (!$string) {
            return '';
        }
        $country = WorldCountry::convert($country);
        if (key_exists($country, self::$classMap)) {
            $class = self::$classMap[$country];

            return $class::convert($string);
        }
        return $string;
    }

}