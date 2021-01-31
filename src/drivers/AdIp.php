<?php


namespace PhpCpm\IpAddress\drivers;

use ipip\db\City;
use ipip\db\CityInfo;
use PhpCpm\IpAddress\IpHandlerInterface;
use PhpCpm\IpAddress\IpInfo;

/**
 * 中国广告协会IP数据库
 * 从https://github.com/wzhe06/ipdatabase找到的2015版，如果有版权问题可联系zougangmu@qq.com移除
 *
 * Class AdIp
 * @package PhpCpm\IpAddress\drivers
 */
class AdIp implements IpHandlerInterface
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
        //@TODO
        return $this;
    }

    /**
     * @param $db
     * @return boolean
     */
    public function loaddb($db = null)
    {
        //@TODO

    }

    /**
     * @return IpInfo
     */
    public function getMap()
    {
        //@TODO
        return [];
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
