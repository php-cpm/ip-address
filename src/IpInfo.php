<?php


namespace PhpCpm\IpAddress;

class IpInfo
{
    /**
     * @var string 国家
     */
    public $country = '';
    /**
     * @var string 省份
     */
    public $province = '';
    /**
     * @var string 地级市
     */
    public $city = '';
    /**
     * @var string 区县
     */
    public $county = '';
    /**
     * @var string 运营商
     */
    public $isp = '';

    /**
     * @var string 托管商
     */
    public $idc = '';
}