<?php


namespace PhpCpm\IpAddress\drivers;

use PhpCpm\IpAddress\IpHandlerInterface;
use PhpCpm\IpAddress\IpInfo;
use PhpCpm\IpAddress\WorldCountry;
use PhpCpm\IpAddress\WorldProvince;

class Ip2region implements IpHandlerInterface
{
    public $error;
    protected $ipInfo = '';

    /**
     * @var \Ip2region $client
     */
    protected $client;
    protected $ip;

    public function __construct($db = null)
    {
        $this->loaddb($db);
        return $this;
    }

    /**
     * @param $ip
     * @return self
     */
    public function init($ip)
    {
        try {
            $this->ip = $ip;
            //国家|区域|省份|城市|ISP
            $this->ipInfo = $this->client->memorySearch($ip)['region'];
        } catch (\Exception $e) {
        }

        return $this;
    }

    /**
     * @param $db
     * @return boolean
     */
    public function loaddb($db = null)
    {
        $this->client = new \Ip2Region($db);
    }

    /**
     * @return IpInfo
     */
    public function getMap()
    {
        $map = new IpInfo();
        if ($this->ipInfo) {
            $result = explode('|', $this->ipInfo);
            $map->country = WorldCountry::convert($result[0]);
            $map->province = WorldProvince::convert($map->country, $result[2]);
            $map->city = rtrim($result[3]) ?: '';
            $map->isp = rtrim($result[4]) ?: '';
        }
        return $map;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        $map = $this->getMap();
        return $map->country;
    }

    /**
     * @return string
     */
    public function getProvince()
    {
        $map = $this->getMap();
        return $map->province;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        $map = $this->getMap();
        return $map->city;
    }

    /**
     * @return string
     */
    public function getISP()
    {
        $map = $this->getMap();
        return $map->isp;
    }
}
