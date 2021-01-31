<?php


namespace PhpCpm\IpAddress\drivers;

use ipip\db\City;
use ipip\db\CityInfo;
use PhpCpm\IpAddress\IpHandlerInterface;
use PhpCpm\IpAddress\IpInfo;
use PhpCpm\IpAddress\WorldCountry;
use PhpCpm\IpAddress\WorldProvince;

class IpIp implements IpHandlerInterface
{
    public $error;
    /**
     * @var CityInfo
     */
    protected $ipInfo = null;

    /**
     * @var City $client
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
            $this->ipInfo = $this->client->findMap($ip, 'CN');
        } catch (\Exception $e) {
            $this->ipInfo = new CityInfo();
        }

        return $this;
    }

    /**
     * @param $db
     * @return boolean
     */
    public function loaddb($db = null)
    {
        if ($db === null) {
            $db = __DIR__ . '/ipipfree.ipdb';
        }
        //https://www.ipip.net/free_download/
        $this->client = new City($db);
    }

    /**
     * @return IpInfo
     */
    public function getMap()
    {
        $map = new IpInfo();
        if ($this->ipInfo) {
            $map->country = WorldCountry::convert($this->ipInfo['country_name']);
            $map->province = WorldProvince::convert($map->country, $this->ipInfo['region_name']);
            $map->city = rtrim($this->ipInfo['city_name']) ?: '';
            $map->isp = rtrim($this->ipInfo['isp_domain'] ?? '') ?: '';
            $map->idc = rtrim($this->ipInfo['idc'] ?? '') ?: '';
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
