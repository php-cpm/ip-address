<?php


namespace PhpCpm\IpAddress\drivers;

use PhpCpm\IpAddress\IpHandlerInterface;
use PhpCpm\IpAddress\IpInfo;
use PhpCpm\IpAddress\libs\Curl;
use PhpCpm\IpAddress\WorldProvince;

/**
 * 仅支持国内IP
//响应示例：
{
"status": 0,
"message": "query ok",
"result": {
"ip": "202.106.0.30",
"location": {
"lng": 116.407526,
"lat": 39.90403
},
"ad_info": {
"nation": "中国",
"province": "",
"city": "",
"adcode": 110000
}
}
}
 * Class Tencentyun
 * @package PhpCpm\IpAddress\drivers
 */
class Tencentyun implements IpHandlerInterface
{
    protected static $url = 'https://apis.map.qq.com/ws/location/v1/ip?key=${token}&ip=${ip}';
    public $error;
    protected $ipInfo = '';
    protected $ip;
    protected $db;
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
        //腾讯限流
        sleep(1);
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
            if ($info['status'] == 0 && isset($info['result'])) {
                $map->country = $info['result']['ad_info']['nation'];
                $map->province = WorldProvince::convert($map->country, $info['result']['ad_info']['province']);
                $map->city = rtrim($info['result']['ad_info']['city']) ?: '';
                $map->isp = '';
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
