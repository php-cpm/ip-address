<?php
include "./vendor/autoload.php";

class TestIp2RegionGlobal
{
    public static $iplist = [
        "37.235.105.233" => ["country" => "美国", "province" => "新泽西州"],
        "184.104.203.243" => ["country" => "美国", "province" => "加利福尼亚州"],
        "162.14.13.51" => ["country" => "中国", "province" => "北京", "idc" => "腾讯云"],
        "119.2.118.110" => ["country" => "不丹"],
        "45.115.73.46" => ["country" => "东帝汶"],
        "185.206.224.145" => ["country" => "丹麦"],
        "178.151.250.153" => ["country" => "乌克兰"],
        "84.54.79.59" => ["country" => "乌兹别克斯坦"],
        "129.205.21.145" => ["country" => "乌干达"],
        "179.25.79.188" => ["country" => "乌拉圭"],
        "154.73.112.226" => ["country" => "乍得"],
        "185.80.141.61" => ["country" => "也门"],
        "210.57.61.129" => ["country" => "中国", "province" => "香港"],
        "195.88.255.54" => ["country" => "亚美尼亚"],
        "185.77.248.5" => ["country" => "以色列"],
        "37.239.16.84" => ["country" => "伊拉克"],
        "109.125.151.71" => ["country" => "伊朗"],
        "190.197.117.243" => ["country" => "伯利兹"],
        "41.79.126.22" => ["country" => "佛得角"],
        "92.38.129.244" => ["country" => "俄罗斯"],
        "37.46.114.112" => ["country" => "保加利亚", "province" => "索非亚"],
        "213.149.62.81" => ["country" => "克罗地亚"],
        "114.142.237.150" => ["country" => "关岛"],
        "197.242.131.200" => ["country" => "冈比亚"],
        "46.182.191.55" => ["country" => "冰岛"],
        "197.149.220.248" => ["country" => "几内亚"],
        "102.141.12.22" => ["country" => "刚果（布）"],
        "41.77.220.76" => ["country" => "刚果（金）"],
        "41.254.65.138" => ["country" => "利比亚"],
        "105.176.227.89" => ["country" => "利比里亚"],
        "50.65.100.218" => ["country" => "加拿大", "province" => "艾伯塔省"],
        "41.215.171.44" => ["country" => "加纳"],
        "154.112.15.135" => ["country" => "加蓬"],
        "37.76.111.17" => ["country" => "匈牙利"],
        "23.237.58.112" => ["country" => "美国", "province" => "纽约州"],
        "185.225.28.9" => ["country" => "北马其顿"],
        "8.3.127.99" => ["country" => "北马里亚纳群岛"],
        "197.231.239.167" => ["country" => "南苏丹"],
        "197.229.3.76" => ["country" => "南非"],
        "102.165.135.14" => ["country" => "博茨瓦纳"],
        "37.211.15.104" => ["country" => "卡塔尔"],
        "197.157.135.184" => ["country" => "卢旺达"],
        "94.242.228.68" => ["country" => "卢森堡"],
        "103.211.52.114" => ["country" => "印度", "province" => "德里"],
        "182.30.95.77" => ["country" => "印度尼西亚", "province" => "雅加达"],
        "181.209.195.222" => ["country" => "危地马拉"],
        "181.196.24.130" => ["country" => "厄瓜多尔"],
        "188.160.205.220" => ["country" => "叙利亚"],
        "152.207.210.253" => ["country" => "古巴"],
        "46.251.196.114" => ["country" => "吉尔吉斯斯坦"],
        "197.241.43.37" => ["country" => "吉布提"],
        "91.246.99.85" => ["country" => "哈萨克斯坦"],
        "190.25.97.158" => ["country" => "哥伦比亚"],
        "200.105.99.50" => ["country" => "哥斯达黎加"],
        "129.0.205.145" => ["country" => "喀麦隆"],
        "78.184.136.255" => ["country" => "土耳其", "province" => "伊斯坦布尔省"],
        "65.48.155.85" => ["country" => "巴巴多斯"],
        "194.183.92.126" => ["country" => "圣马力诺"],
        "181.199.233.77" => ["country" => "圭亚那"],
        "169.255.184.151" => ["country" => "坦桑尼亚"],
        "41.39.111.145" => ["country" => "埃及"],
        "196.188.50.53" => ["country" => "埃塞俄比亚"],
        "103.250.2.95" => ["country" => "基里巴斯"],
        "109.75.51.154" => ["country" => "塔吉克斯坦"],
        "154.124.234.207" => ["country" => "塞内加尔"],
        "24.135.89.233" => ["country" => "塞尔维亚"],
        "41.205.240.73" => ["country" => "塞拉利昂"],
        "93.182.106.192" => ["country" => "土耳其"],
        "41.220.111.246" => ["country" => "塞舌尔"],
        "187.141.28.34" => ["country" => "墨西哥"],
        "196.170.234.3" => ["country" => "多哥"],
        "179.52.1.135" => ["country" => "多米尼加"],
        "37.120.155.148" => ["country" => "奥地利", "province" => "维也纳州"],
        "190.207.232.91" => ["country" => "委内瑞拉"],
        "103.209.20.64" => ["country" => "孟加拉国"],
        "105.172.25.156" => ["country" => "安哥拉"],
        "38.92.125.109" => ["country" => "美国", "province" => "维也纳州"],
        "119.252.112.234" => ["country" => "密克罗尼西亚联邦"],
        "197.210.54.170" => ["country" => "尼日利亚"],
        "41.203.147.2" => ["country" => "尼日尔"],
        "110.44.115.183" => ["country" => "尼泊尔"],
        "188.161.54.35" => ["country" => "巴勒斯坦"],
        "108.60.227.41" => ["country" => "巴哈马"],
        "39.32.52.213" => ["country" => "巴基斯坦"],
        "64.119.198.184" => ["country" => "巴巴多斯"],
        "180.150.254.249" => ["country" => "巴布亚新几内亚"],
        "181.126.128.54" => ["country" => "巴拉圭"],
        "190.219.35.101" => ["country" => "巴拿马"],
        "78.110.70.0" => ["country" => "巴林"],
        "189.4.76.12" => ["country" => "巴西"],
        "212.52.159.73" => ["country" => "布基纳法索"],
        "185.51.134.236" => ["country" => "希腊", "province" => "阿提卡大区"],
        "103.30.249.130" => ["country" => "帕劳"],
        "173.225.209.125" => ["country" => "开曼群岛"],
        "185.93.180.83" => ["country" => "德国", "province" => "黑森州"],
        "151.40.65.66" => ["country" => "意大利", "province" => "托斯卡纳大区"],
        "212.3.198.173" => ["country" => "拉脱维亚"],
        "185.253.97.141" => ["country" => "挪威", "province" => "奥斯陆郡"],
        "81.92.149.60" => ["country" => "捷克"],
        "93.116.254.242" => ["country" => "摩尔多瓦"],
        "105.67.6.160" => ["country" => "摩洛哥"],
        "91.207.175.196" => ["country" => "美国", "province" => "加利福尼亚州"],
        "202.152.71.201" => ["country" => "文莱"],
        "27.123.136.147" => ["country" => "斐济"],
        "165.73.133.200" => ["country" => "斯威士兰"],
        "196.245.151.36" => ["country" => "斯洛伐克", "province" => "布拉迪斯拉发州"],
        "188.230.232.56" => ["country" => "斯洛文尼亚"],
        "112.134.47.176" => ["country" => "斯里兰卡"],
        "5.62.35.10" => ["country" => "新加坡"],
        "118.149.100.207" => ["country" => "新西兰", "province" => "奥克兰大区"],
        "103.121.209.6" => ["country" => "日本", "province" => "东京都"],
        "181.42.15.220" => ["country" => "智利"],
        "103.25.95.46" => ["country" => "柬埔寨"],
        "199.83.199.134" => ["country" => "格林纳达"],
        "178.134.150.14" => ["country" => "格鲁吉亚"],
        "212.22.73.50" => ["country" => "俄罗斯"],
        "45.9.249.44" => ["country" => "阿联酋"],
        "77.243.191.21" => ["country" => "比利时", "province" => "布鲁塞尔－首都大区"],
        "41.188.67.35" => ["country" => "毛里塔尼亚"],
        "102.163.30.93" => ["country" => "毛里求斯"],
        "202.134.31.163" => ["country" => "汤加"],
        "95.219.195.236" => ["country" => "沙特阿拉伯"],
        "176.67.168.141" => ["country" => "法国", "province" => "法兰西岛大区"],
        "81.248.37.126" => ["country" => "法属圭亚那"],
        "202.90.79.30" => ["country" => "法属波利尼西亚"],
        "51.83.136.66" => ["country" => "波兰", "province" => "马佐夫舍省"],
        "24.50.225.231" => ["country" => "波多黎各"],
        "109.175.111.28" => ["country" => "波斯尼亚和黑塞哥维那"],
        "101.108.120.237" => ["country" => "泰国", "province" => "巴吞他尼府"],
        "5.35.166.179" => ["country" => "泽西"],
        "41.60.92.65" => ["country" => "津巴布韦"],
        "181.115.24.170" => ["country" => "洪都拉斯"],
        "190.115.182.95" => ["country" => "海地"],
        "1.128.108.0" => ["country" => "澳大利亚", "province" => "昆士兰州"],
        "23.92.127.58" => ["country" => "爱尔兰", "province" => "都柏林郡"],
        "165.231.161.100" => ["country" => "芬兰", "province" => "哈尔尤县"],
        "72.27.164.96" => ["country" => "牙买加"],
        "170.84.11.115" => ["country" => "特立尼达和多巴哥"],
        "181.115.249.196" => ["country" => "玻利维亚"],
        "46.246.123.46" => ["country" => "挪威"],
        "185.230.125.82" => ["country" => "瑞士"],
        "103.75.21.250" => ["country" => "瓦努阿图"],
        "93.125.107.79" => ["country" => "白俄罗斯", "province" => "明斯克州"],
        "198.207.18.173" => ["country" => "百慕大"],
        "178.208.223.31" => ["country" => "直布罗陀"],
        "94.128.16.90" => ["country" => "科威特"],
        "154.232.212.138" => ["country" => "科特迪瓦"],
        "185.67.177.15" => ["country" => "阿尔巴尼亚"],
        "181.67.253.155" => ["country" => "秘鲁"],
        "41.231.5.33" => ["country" => "突尼斯"],
        "78.61.249.51" => ["country" => "立陶宛"],
        "41.79.199.51" => ["country" => "索马里"],
        "188.247.77.65" => ["country" => "约旦"],
        "105.232.76.72" => ["country" => "纳米比亚"],
        "103.231.94.177" => ["country" => "缅甸"],
        "95.76.58.47" => ["country" => "罗马尼亚", "province" => "苏恰瓦县"],
        "162.227.83.81" => ["country" => "美国"],
        "208.49.194.164" => ["country" => "美国"],
        "208.147.18.139" => ["country" => "美属萨摩亚"],
        "115.84.98.95" => ["country" => "老挝"],
        "102.140.220.188" => ["country" => "肯尼亚"],
        "185.103.110.208" => ["country" => "芬兰"],
        "102.123.129.20" => ["country" => "苏丹"],
        "186.179.209.85" => ["country" => "苏里南"],
        "81.92.200.251" => ["country" => "英国"],
        "72.51.126.111" => ["country" => "英属维尔京群岛"],
        "66.111.61.198" => ["country" => "美国"],
        "197.235.229.16" => ["country" => "莫桑比克"],
        "129.232.49.47" => ["country" => "莱索托"],
        "130.105.167.198" => ["country" => "菲律宾", "province" => "马尼拉都会区"],
        "201.247.43.110" => ["country" => "萨尔瓦多"],
        "203.99.157.76" => ["country" => "萨摩亚"],
        "94.126.172.58" => ["country" => "葡萄牙"],
        "202.131.229.34" => ["country" => "蒙古"],
        "185.230.124.76" => ["country" => "西班牙"],
        "197.234.221.43" => ["country" => "贝宁"],
        "41.223.118.67" => ["country" => "赞比亚"],
        "116.108.48.151" => ["country" => "越南", "province" => "胡志明市"],
        "89.219.185.240" => ["country" => "阿塞拜疆"],
        "196.195.250.85" => ["country" => "阿富汗"],
        "41.102.170.63" => ["country" => "阿尔及利亚"],
        "80.246.28.36" => ["country" => "阿尔巴尼亚", "province" => "地拉那县"],
        "188.66.238.22" => ["country" => "阿曼"],
        "181.46.162.139" => ["country" => "阿根廷"],
        "92.98.111.21" => ["country" => "阿联酋"],
        "181.41.58.62" => ["country" => "阿鲁巴"],
        "102.69.220.28" => ["country" => "加纳"],
        "223.62.169.17" => ["country" => "韩国"],
        "43.231.29.147" => ["country" => "马尔代夫"],
        "92.39.204.242" => ["country" => "马恩岛"],
        "105.234.160.3" => ["country" => "马拉维"],
        "175.139.89.131" => ["country" => "马来西亚", "province" => "吉隆坡联邦直辖区"],
        "103.202.150.128" => ["country" => "马绍尔群岛"],
        "141.8.9.77" => ["country" => "马耳他"],
        "154.126.64.147" => ["country" => "马达加斯加"],
        "217.64.103.105" => ["country" => "马里"],
        "185.97.92.119" => ["country" => "黎巴嫩"],
        "79.143.111.241" => ["country" => "黑山"],
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

TestIp2RegionGlobal::testCountry();

