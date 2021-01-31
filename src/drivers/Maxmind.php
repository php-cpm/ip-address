<?php


namespace PhpCpm\IpAddress\drivers;

use MaxMind\Db\Reader;
use PhpCpm\IpAddress\IpHandlerInterface;
use PhpCpm\IpAddress\IpInfo;
use PhpCpm\IpAddress\WorldCountry;
use PhpCpm\IpAddress\WorldProvince;

/**
 * maxmind geoip 2 lite 注册即可下载免费的IP库文件
 * https://dev.maxmind.com/geoip/geoip2/geolite2/
 * 各国精确度备注，中国只有53%
 * https://www.maxmind.com/en/geoip2-city-accuracy-comparison
 * Class Maxmind
 * @package PhpCpm\IpAddress\drivers
 */
class Maxmind implements IpHandlerInterface
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
            $db = new Reader($this->db);
            $this->ipInfo = $db->get($ip);
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
        if ($db === null) {
            $db = __DIR__ . '/GeoLite2-City.mmdb';
        }
        $this->db = $db;
    }

    /**
     * @return IpInfo
     */
    public function getMap()
    {
        $map = new IpInfo();
        if ($this->ipInfo) {
            $map->country = WorldCountry::convert($this->ipInfo['country']['names']['en']);
            $province = $this->ipInfo['subdivisions'][0]['names']['en'] ?? '';
            $map->province = WorldProvince::convert($map->country, $province);

            if (in_array($map->country, ['台湾', '香港', '澳门'])) {
                $map->province = $map->country;
                $map->country = '中国';
            }
            $map->city = rtrim($this->ipInfo['city']['names']['zh-CN'] ?? '') ?: '';
            $map->isp = rtrim($this->ipInfo['isp'] ?? '') ?: '';
            $map->idc = rtrim($this->ipInfo['area'] ?? '') ?: '';
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
