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
        $path = "/v3/pay/transactions/jsapi";
        $json = json_encode([]);
        $this->postRequest($path,$json);
    }

    protected function getReuest(string $url)
    {

    }

    protected function postRequest(string $path,string $json)
    {
        $time = time();
        $nonce = strtoupper( Random::character(16));
        $body = "{POST}\n{$path}\n{$time}\n{$nonce}\n{$json}\n";
        openssl_sign($body, $raw_sign, $this->config->getMchPrivateKey(), 'sha256WithRSAEncryption');
        $sign = base64_encode($raw_sign);

    }

}