<?php

namespace EasySwoole\Pay;

use EasySwoole\Pay\Config\WechatConfig;
use EasySwoole\Utility\Random;

class Wechat
{
    function __construct(
        protected WechatConfig $config
    )
    {

    }

    function jsApi()
    {

    }

    protected function getReuest(string $url)
    {

    }

    protected function postRequest(string $url,string $json)
    {
        $path = "";
        $time = time();
        $nonce = strtoupper( Random::character(16));
        $body = "{POST}\n{$path}\n{$time}\n{$nonce}\n{$json}\n";
    }

}