<?php


namespace PhpCpm\IpAddress;


class IpRegion
{
    public function __construct()
    {
    }

    /**
     * @param $driver
     * @return IpHandlerInterface
     */
    public function drvier($driver)
    {
        return new $driver;
    }

}