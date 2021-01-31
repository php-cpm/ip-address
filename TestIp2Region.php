<?php
include "./vendor/autoload.php";

class TestIp2Region
{
    public static $iplist = [
        //本地
//        '127.0.0.1' => ['country' => '', 'province' => '', 'city' => '内网IP', 'isp' => '内网IP'],
        //百度
        '220.181.38.148' => ['country' => '中国', 'province' => '北京'],//, 'city' => '北京市', 'isp' => '电信'
        //renren
        '120.133.2.243' => ['country' => '中国', 'province' => '北京'],//, 'city' => '北京市', 'isp' => '世纪互联'
        //新浪 加利福尼亚-圣何塞
//        '66.102.251.24' => ['country' => '美国', 'province' => '弗吉尼亚州'],//, 'city' => '', 'isp' => '电信'
        //google
//        '8.7.198.46' => ['country' => '美国', 'province' => '科罗拉多州'],//, 'city' => '', 'isp' => 'Level3'
        '120.229.242.115' => ['country' => '中国', 'province' => '广东'],
        '180.155.65.31' => ['country' => '中国', 'province' => '上海'],
        '117.132.192.254' => ['country' => '中国', 'province' => '北京'],
        '112.114.107.5' => ['country' => '中国', 'province' => '云南'],
        '39.154.167.81' => ['country' => '中国', 'province' => '内蒙古'],
        '111.199.78.5' => ['country' => '中国', 'province' => '北京'],
        '118.165.130.225' => ['country' => '中国', 'province' => '台湾'],
        '139.214.254.246' => ['country' => '中国', 'province' => '吉林'],
        '218.89.215.229' => ['country' => '中国', 'province' => '四川'],
        '111.30.206.41' => ['country' => '中国', 'province' => '天津'],
        '111.113.79.22' => ['country' => '中国', 'province' => '宁夏'],
        '114.103.75.76' => ['country' => '中国', 'province' => '安徽'],
        '58.58.52.50' => ['country' => '中国', 'province' => '山东'],
        '171.126.93.198' => ['country' => '中国', 'province' => '山西'],
        '116.23.81.105' => ['country' => '中国', 'province' => '广东'],
        '117.140.57.65' => ['country' => '中国', 'province' => '广西'],
        '223.114.237.212' => ['country' => '中国', 'province' => '新疆'],
        '223.104.147.238' => ['country' => '中国', 'province' => '江苏'],
        '117.164.235.76' => ['country' => '中国', 'province' => '江西'],
        '27.189.200.229' => ['country' => '中国', 'province' => '河北'],
        '115.60.176.123' => ['country' => '中国', 'province' => '河南'],
        '112.17.245.20' => ['country' => '中国', 'province' => '浙江'],
        '112.67.88.172' => ['country' => '中国', 'province' => '海南'],
        '183.92.250.135' => ['country' => '中国', 'province' => '湖北'],
        '113.246.35.238' => ['country' => '中国', 'province' => '湖南'],
        '128.90.186.190' => ['country' => '中国', 'province' => '澳门'],
        '42.90.148.181' => ['country' => '中国', 'province' => '甘肃'],
        '58.22.113.151' => ['country' => '中国', 'province' => '福建'],
        '223.104.26.14' => ['country' => '中国', 'province' => '西藏'],
        '1.207.78.134' => ['country' => '中国', 'province' => '贵州'],
        '113.238.139.170' => ['country' => '中国', 'province' => '辽宁'],
        '125.84.185.127' => ['country' => '中国', 'province' => '重庆'],
        '113.139.195.32' => ['country' => '中国', 'province' => '陕西'],
        '43.242.180.2' => ['country' => '中国', 'province' => '青海'],
        '47.75.138.117' => ['country' => '中国', 'province' => '香港'],
        '117.179.253.163' => ['country' => '中国', 'province' => '黑龙江'],
    ];

    public static function testCountry()
    {
        echo '对比国家';
        $drivers = [
            "Maxmind" => \PhpCpm\IpAddress\drivers\Maxmind::class,
            "Ip2Location" => \PhpCpm\IpAddress\drivers\Ip2Location::class,
            "Ip2region" => \PhpCpm\IpAddress\drivers\Ip2region::class,
            "IpIp" => \PhpCpm\IpAddress\drivers\IpIp::class,
            "chunzhen" => \PhpCpm\IpAddress\drivers\IpLocation::class,

            "TaobaoIp" => \PhpCpm\IpAddress\drivers\TaobaoIp::class,
            "Baidulbs" => \PhpCpm\IpAddress\drivers\Baiduyun::class,
            "Tencentlbs" => \PhpCpm\IpAddress\drivers\Tencentyun::class,
        ];
        $report = [];
        $ipCountry = [];
        $falseList = [];
        foreach ($drivers as $key => $driver) {
            echo $driver . "\n";
            $i = new \PhpCpm\IpAddress\IpRegion();
            $i = $i->drvier($driver);
            $count = count(self::$iplist);
            $failCount = 0;
            foreach (self::$iplist as $ip => $info) {
                    if(!isset($ipCountry[$ip])) {
                        $ipCountry[$ip] = [];
                    }
                $result = $i->init($ip)->getMap();
                $ipCountry[$ip][$key] = $result->country;
                if (self::checkCountry($ip, $result, $info)) {
                    //echo $ip . 'success' . "\n";
                } else {
                    $falseList[] = $ip;
//                    print_r($result);
                    echo $ip . 'fail' . "\n";
                    $failCount++;
                }
            }
            $report[$key] = [$failCount, $count];
        }
        print_r($report);
//        array_unique($falseList);
//        $total = [];
//        foreach ($falseList as $ip) {
//            $total[$ip] = $ipCountry[$ip];
//        }
//        print_r($total);
    }

    public static function testProvince()
    {
        echo '对比省份';
        $drivers = [
            "Maxmind" => \PhpCpm\IpAddress\drivers\Maxmind::class,
            "Ip2Location" => \PhpCpm\IpAddress\drivers\Ip2Location::class,
            "Ip2region" => \PhpCpm\IpAddress\drivers\Ip2region::class,
            "IpIp" => \PhpCpm\IpAddress\drivers\IpIp::class,
            "chunzhen" => \PhpCpm\IpAddress\drivers\IpLocation::class,

//            "TaobaoIp" => \PhpCpm\IpAddress\drivers\TaobaoIp::class,
//            "Baidulbs" => \PhpCpm\IpAddress\drivers\Baiduyun::class,
//            "Tencentlbs" => \PhpCpm\IpAddress\drivers\Tencentyun::class,
        ];
        $report = [];
        $ipCountry = [];
        $falseList = [];
        foreach ($drivers as $key => $driver) {
            echo $driver . "\n";
            $i = new \PhpCpm\IpAddress\IpRegion();
            $i = $i->drvier($driver);
            $count = count(self::$iplist);
            $failCount = 0;
            foreach (self::$iplist as $ip => $info) {
                if(!isset($ipCountry[$ip])) {
                    $ipCountry[$ip] = [];
                }
                $result = $i->init($ip)->getMap();
                $ipCountry[$ip][$key] = $result->province;
                if (self::checkProvince($ip, $result, $info)) {
                    //echo $ip . 'success' . "\n";
                } else {
                    $falseList[] = $ip;
//                    print_r($result);
                    echo $ip . 'fail' . "\n";
                    $failCount++;
                }
            }
            $report[$key] = [$failCount, $count];
        }
        print_r($report);
//        array_unique($falseList);
//        $total = [];
//        foreach ($falseList as $ip) {
//            $total[$ip] = $ipCountry[$ip];
//        }
//        print_r($total);
    }

    public static function check($ip, $reuslt, $compare)
    {
        foreach ($compare as $key => $value) {
            if ($reuslt->{$key} == $value) {
                continue;
            } else {
                echo $key . ' ' . $reuslt->{$key} . '!=' . $value . "\n";
                return false;
            }
        }
        return true;
    }

    public static function checkProvince($ip, $reuslt, $compare)
    {
        if ($reuslt->province == $compare['province']) {
            return true;
        } else {
            echo 'province ' . $reuslt->province . '!=' . $compare['province'] . "\n";
            return false;
        }
    }

    public static function checkCountry($ip, $reuslt, $compare)
    {
        if ($reuslt->country == $compare['country']) {
            return true;
        } else {
            echo 'country ' . $reuslt->country . '!=' . $compare['country'] . "\n";
            return false;
        }
    }
}

//TestIp2Region::testCountry();
TestIp2Region::testProvince();