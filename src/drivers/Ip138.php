<?php


namespace PhpCpm\IpAddress\drivers;

use PhpCpm\IpAddress\IpHandlerInterface;
use PhpCpm\IpAddress\IpInfo;
use PhpCpm\IpAddress\libs\Curl;
use PhpCpm\IpAddress\WorldCountry;
use PhpCpm\IpAddress\WorldProvince;

class Ip138 implements IpHandlerInterface
{
    protected static $url = 'https://api.ip138.com/ip/?ip=${ip}&datatype=jsonp&token=${token}';
    public $error;
    protected $ipInfo = '';
    protected $ip;
    protected $db;
    //临时key有数量限制，请替换为自己的key
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
            if ($info['code'] == 0 && isset($info['data']['country'])) {
                $map->country = WorldCountry::convert($info['data']['country'] ?? '');
                $map->province = WorldProvince::convert($map->country, $info['data']['region'] ?? '');
                $map->city = rtrim($info['data']['city'] ?? '') ?: '';
                $map->county = rtrim($info['data']['county'] ?? '') ?: '';
                $map->isp = rtrim($info['data']['isp'] ?? '') ?: '';
                $map->idc = rtrim($info['data']['area'] ?? '') ?: '';
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
