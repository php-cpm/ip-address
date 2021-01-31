<?php


namespace PhpCpm\IpAddress;


interface LocationHandlerInterface
{
    /**
     * 最大程度兼容到统一格式
     * @param $string
     * @return mixed
     */
    public static function convert($string);
}