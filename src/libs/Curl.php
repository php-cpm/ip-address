<?php

namespace PhpCpm\IpAddress\libs;

class Curl
{
    public static function send($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url); //定义请求地址
        curl_setopt($ch, CURLOPT_TIMEOUT, 2); //定义请求类型，当然那个提交类型那一句就不需要了
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1); //定义请求类型，当然那个提交类型那一句就不需要了
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); //定义请求类型，当然那个提交类型那一句就不需要了
        curl_setopt($ch, CURLOPT_HEADER, 0); //定义是否显示状态头 1：显示 ； 0：不显示
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//定义是否直接输出返回流
        $res = curl_exec($ch);
        curl_close($ch);//关闭
        return $res;
    }
}