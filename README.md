# IP库大集成

## 项目集成用法

为了测试各IP库效果，项目封装了一些方法，可以用于开发ip库相关的数据格式化。
类库引用方法

```
composer require php-cpm/ip-address
```

调用方法如下，采用了驱动模式

```php
<?php
//ipv4地址
$ip = '127.0.0.1';
$ipdb = new \PhpCpm\IpAddress\IpRegion();
$driver  = \PhpCpm\IpAddress\drivers\IpIp::class;

$ipdb->drvier($driver)->init($ip)->getMap();

//部分库需要注册开发者账号申请AccessKey
$driver = \PhpCpm\IpAddress\drivers\Baiduyun::class;
$ipdb->drvier($driver)->setToken('testToken')->init($ip)->getMap();
```

可用驱动
```
"Maxmind" => \PhpCpm\IpAddress\drivers\Maxmind::class,
"Ip2Location" => \PhpCpm\IpAddress\drivers\Ip2Location::class,
"Ip2region" => \PhpCpm\IpAddress\drivers\Ip2region::class,
"IpIp" => \PhpCpm\IpAddress\drivers\IpIp::class,
"chunzhen" => \PhpCpm\IpAddress\drivers\IpLocation::class,
"TaobaoIp" => \PhpCpm\IpAddress\drivers\TaobaoIp::class,
"Baidulbs" => \PhpCpm\IpAddress\drivers\Baiduyun::class,
"Tencentlbs" => \PhpCpm\IpAddress\drivers\Tencentyun::class,
```

## 项目使命

IP库是一个基础服务，关注点在于准确性，也在于精确性。比如告诉我是错的地址比告诉我不知道是哪里好，告诉我对的地址比错的地址好。

使用IP库以及使用定位库的最大问题是没有唯一编码表，很难确定IP库返回的数据字符串是否跟库里的数据匹配，因此次项目将国内外常用的IP库做了数据转换及翻译处理，使大家能在一个起跑线上进行对比。

有了基准测试对比，才能便于后续IP库的选型，这里只收录了免费的IP库。

如果你有一个付费的IP库，你很难知道花的钱是否值得，说不定还不如免费的好，有了这个项目后你能节省大量工作，立刻开始对比。

## 结论

先上结论，后面文章的依据是采用各个数据库对照实际IP采样数据而成

- 中文国内离线库 优选 IP2REGION
- 中文全球离线库 优选 IPIP
- 英文全球离线库 优选 ip2location，最准确
- 多语言全球离线库 优选 maxmind，相应的国内数据最差
- 中文在线库 淘宝IP库，国际误差较大，胜在免费
- 中文在线库备选 ip138，百度接的库，大众公信力高

## 我自己的解决方案

由于我只需国家与国内省份的IP库，IPIP有个很大问题是会把一些IP定位到非国家，不容易做数据统计，ip2location与IP2REGION结合并做一些简单翻译即可满足需求

## 详细评比

IP库的功能是根据IP拿到用户所在位置，最重要的是准确性，其次是精确性
为了判断IP位置本项目集成了业界已知公开免费数据，结合业务场景上用到的IP做对比参考，评估各IP库的准确性及精确性

1. 纯真IP库 itbdw/ip-database 预计很拉胯，准确性、精确性均不足
2. IPIP.net ipip/db 技术流，准确性高，但精确性不足，换句话说不瞎标
3. ip2region zoujingli/ip2region 准确性高，精确性也高，国外拉胯
4. 淘宝IP库，大陆的信息全面准确，海外未知


- 阿里云在线服务费用不菲，还有并发限制
https://www.aliyun.com/product/dns/geoip
- 百度搜索使用的IP库是ip138提供的 36,000元/年
- ipplus360使用的IP库 36,000元/年

以新浪的IP 66.102.251.24 为例
```
https://ip.chinaz.com/66.102.251.24
美国 中国电信美洲公司
https://www.ip138.com/iplookup.asp?ip=66.102.251.24&action=2
美国 中国电信节点 电信

http://ip.taobao.com/ipSearch
美国	加利福尼亚	圣何塞		电信

https://tool.lu/ip/
归属地(纯真数据)：	美国 中国电信美洲公司
归属地(ipip)：	美国 美国 -
归属地(淘宝数据)：	美国 加利福尼亚 圣何塞 电信
归属地(IP2REGION)：	美国 弗吉尼亚 电信
```

##离线数据库对比（基准为Ip2region）

类库 | 简介 
--- | --- 
Ip2region | 互联网数据整合 
IpIp.net | 互联网老兵新项目 
Maxmind | 国外免费库 maxmind-db/reader 
IP2Location | 国外免费库 ip2location/ip2location-php 
纯真IpLocation | 纯真IP库，十多年免费提供 IP库源站https://www.cz88.net/ 

##在线数据库对比（基准为Ip2region）

类库 | 简介 | 总数 | 失败数
--- | --- | --- | ---
TaobaoIp库 | 淘宝收集整理的免费IP库 | - | -
ip138 | 宣称用GPS/rDNS/BGP/ASN等数据整理的 Geolocation IP地址数据库 | - | -
阿里云ip库 | 付费，信息似乎还没淘宝IP库准 | - | -
聚合API | https://www.juhe.cn/，免费每日最大1百次 | - | -
Ucloud | 与ipip.net合作的数据源，可以参考IPip.net离线库，免费每日最大1百次 | - | -
腾讯lbs | 基于腾讯地图收集的数据，免费每日最大1万次 https://lbs.qq.com/service/webService/webServiceGuide/webServiceIp | - | -
百度lbs | 仅国内，基于百度地图收集的数据，免费每日最大1千次 http://lbsyun.baidu.com/index.php?title=webapi/ip-api | - | -
埃文IP库 | https://www.ipplus360.com/ | - | -

测试以Ip2region数据为基准
含38条国内IP，其中1条IPIP无法识别省份
1条新浪美国IP，淘宝识别位置为加利福尼亚-圣何塞，ip2region识别位置为弗吉尼亚，无法断定谁对，IPIP和纯真只能定位到国家
1条google美国IP，纯真没有结构化数据只有idc数据，淘宝的城市显示XX为错误数据，IPIP只能识别到美国

IPIP的数据库在这里最差，后续还要更多数据做对比分析
淘宝和IP2region暂时排名不分先后

## 国内省份IP库对比

如果IP库定位的省份错了，有两种解释，一种是IP库较为陈旧，一种是统计方法差异导致。
由于IpI的数据库是能拿到的最新数据。
以Ip2region为数据基准，Ip2region最优，IpIp效果最差。
```
Array
(
    [Maxmind] => Array
        (
            [0] => 14
            [1] => 38
        )

    [Ip2Location] => Array
        (
            [0] => 2
            [1] => 38
        )

    [Ip2region] => Array
        (
            [0] => 0
            [1] => 38
        )

    [TaobaoIp] => Array
        (
            [0] => 0
            [1] => 38
        )

    [IpIp] => Array
        (
            [0] => 1
            [1] => 38
        )

    [chunzhen] => Array
        (
            [0] => 0
            [1] => 38
        )

)
```

由于样本较少，未能充分比较出各自差异，

个人评分结论：
```
Ip2region = taobao = chunzhen > IpIp > Ip2Location > Maxmind
```

## 国家级IP库对比

如果IP库定位的国家错了，有两种解释，一种是IP库较为陈旧，一种是统计方法差异导致。
由于Ip2Location、maxmind的数据库是能拿到的最新数据。
以Ip2Location为数据基准，maxmind最优，拿部分IP以百度搜索结果做评判，maxmind得分略高。IpIp的表现明显比国内其他IP库表现好，说明确实下功夫了。

```
Array
(
    [Maxmind] => Array
        (
            [0] => 5
            [1] => 198
        )

    [Ip2Location] => Array
        (
            [0] => 0
            [1] => 198
        )

    [Ip2region] => Array
        (
            [0] => 21
            [1] => 198
        )

    [IpIp] => Array
        (
            [0] => 12
            [1] => 198
        )

    [chunzhen] => Array
        (
            [0] => 15
            [1] => 198
        )

    [TaobaoIp] => Array
        (
            [0] => 13
            [1] => 198
        )
)
```

个人评分结论：
```
Maxmind > Ip2Location > IpIp > taobao > chunzhen > Ip2region
```

## 同类产品

https://github.com/stevebauman/location


## 大感谢

感谢互联网上默默奉献的人们，热泪盈眶的那种。

项目为了对比各IP库优劣用到的第三方PHP类库有：
`ipip/db`、`zoujingli/ip2region`、`maxmind-db/reader`、`ip2location/ip2location-php`、`itbdw/ip-database`

为本实验节省了大量时间，没有关注版权协议，如果遇到版权问题可以私信我删除。

## 开发测试方法

 - 下载代码库
 - 执行`composer install`安装依赖
 - 编辑`TestIp2Region.php`选择要测试的IP库，执行`php TestIp2Region.php` 查看对比数据

## 帮我完善项目

TODO任务：

- 现在只支持中国、美国的省份级别对比，因为免费IP库精度基本就这样了，而且中、美的需求最大，欢迎提供更多的国家地区的支持
- 语言转换，现在都统一转为了中文，多国语就可以通过这一基准进行匹配翻译了
- 欢迎更多IP库对比接入