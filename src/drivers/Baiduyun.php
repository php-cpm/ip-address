<?php


namespace PhpCpm\IpAddress\drivers;

use PhpCpm\IpAddress\IpHandlerInterface;
use PhpCpm\IpAddress\IpInfo;
use PhpCpm\IpAddress\libs\Curl;
use PhpCpm\IpAddress\WorldCountry;
use PhpCpm\IpAddress\WorldProvince;

/**
 * 仅支持国内IP
 * {
 * "address": "CN|天津|天津|None|DXTNET|0|0",
 * "content": {
 * "address_detail": {
 * "province": "天津市",
 * "city": "天津市",
 * "district": "",
 * "street": "",
 * "street_number": "",
 * "city_code": 332
 * },
 * "address": "天津市",
 * "point": {
 * "y": "4715083.22",
 * "x": "13047990"
 * }
 * },
 * "status": 0
 * }
 * Class Baiduyun
 * @package PhpCpm\IpAddress\drivers
 */
class Baiduyun implements IpHandlerInterface
{
    protected static $url = 'https://api.map.baidu.com/location/ip?ak=${token}&ip=${ip}';
    public $error;
    protected $ipInfo = '';
    protected $ip;
    protected $db;
    //token为临时key，有并发限制，项目使用请自行设置
    protected $token = '---';

    public function __construct($db = null)
    {
        return $this;
    }

    public static function curl($ip, $token)
    {
        $url = str_replace('${ip}', $ip, self::$url);
        $url = str_replace('${token}', $token, $url);

        return Curl::send($url);
    }

    public function setToken($token)
    {
        $this->token = $token;
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
            $this->ipInfo = self::curl($ip, $this->token);
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
        if($this->token == '---') {
            throw new \Exception('Please set Token by yourself');
        }
        $map = new IpInfo();
        if ($this->ipInfo) {
            $info = json_decode($this->ipInfo, true);

            //CN|北京|北京|None|CHINANET|0|0
            if ($info['status'] == 0 && isset($info['address'])) {
                $result = explode('|', $info['address']);
                $map->country = $result[0];
                if($map->country == 'CN' || $map->country == 'TW') {
                    $map->country = '中国';
                }
                $map->province = WorldProvince::convert($map->country, $result[1]);
                $map->city = rtrim($result[2]) ?: '';
                $map->isp = rtrim($result[4]) ?: '';
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
