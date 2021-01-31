<?php


namespace PhpCpm\IpAddress\drivers;

use itbdw\Ip\IpLocation as IPL;
use PhpCpm\IpAddress\IpHandlerInterface;
use PhpCpm\IpAddress\IpInfo;
use PhpCpm\IpAddress\WorldCountry;
use PhpCpm\IpAddress\WorldProvince;

class IpLocation implements IpHandlerInterface
{
    public $error;
    protected $ipInfo = '';

    protected $ip;
    protected $db;

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
            $this->ipInfo = IPL::getLocation($ip, $this->db);
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
        $this->db = $db;
    }

    /**
     * @return IpInfo
     */
    public function getMap()
    {
        $map = new IpInfo();
        if ($this->ipInfo) {
            $map->country = WorldCountry::convert($this->ipInfo['country']);
            $map->province = WorldProvince::convert($map->country, $this->ipInfo['province']);
            $map->city = rtrim($this->ipInfo['city']) ?: '';
            $map->isp = rtrim($this->ipInfo['isp']) ?: '';
            $map->idc = rtrim($this->ipInfo['area']) ?: '';
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
