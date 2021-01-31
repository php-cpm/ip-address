<?php


namespace PhpCpm\IpAddress\drivers;

use IP2Location\Database;
use PhpCpm\IpAddress\IpHandlerInterface;
use PhpCpm\IpAddress\IpInfo;
use PhpCpm\IpAddress\WorldCountry;
use PhpCpm\IpAddress\WorldProvince;

/**
 * ip2location 注册即可下载免费的IP库文件
 * https://lite.ip2location.com/file-download
 * 官方数据显示国家级数据准确度>98.0%
 * https://lite.ip2location.com/edition-comparison
 * 各国精确度备注，中国79.27%
 * https://www.ip2location.com/data-accuracy
 * Class Ip2Location
 * @package PhpCpm\IpAddress\drivers
 */
class Ip2Location implements IpHandlerInterface
{
    public $error;
    protected $ipInfo = [];

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
            $db = new Database($this->db);

            $this->ipInfo = $db->lookup($ip);

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
            $db = __DIR__ . '/IP2LOCATION-LITE-DB3.BIN';
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
            $map->country = WorldCountry::convert($this->ipInfo['countryName']);
            $map->province = WorldProvince::convert($this->ipInfo['countryName'], $this->ipInfo['regionName']);
            $map->city = WorldProvince::convert($this->ipInfo['countryName'], $this->ipInfo['cityName']);
            $map->isp = rtrim($this->ipInfo['isp']) ?: '';
            if ($map->isp == 'This parameter is unavailable in selected .BIN data file. Please upgrade.') {
                $map->isp = '';
            }
            $map->idc = rtrim($this->ipInfo['domainName']) ?: '';
            if ($map->idc == 'This parameter is unavailable in selected .BIN data file. Please upgrade.') {
                $map->idc = '';
            }
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
