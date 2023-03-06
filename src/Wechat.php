<?php

namespace EasySwoole\Pay;

use EasySwoole\HttpClient\HttpClient;
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
        $json = json_encode([
            'appid'=>'wx47e12b9ddcc41b44',
            'description'=>"测试",
            'out_trade_no'=>"NO".time(),
            'mchid'=>"1526422621",
            'notify_url'=>"https://www.baidu.com",
            'amount'=>[
                'total'=>1,
                'currency'=>"CNY"
            ],
            "payer"=>[
                'openid'=>"o3Mk26HWFAGp6zlUpeyqlLFtYgu4"
            ]
        ]);
        $this->postRequest($path,$json);
    }

    function query(string $out_trade_no)
    {
        $path = "/v3/pay/transactions/id/{$out_trade_no}?mchid={$this->config->getMchId()}";
        $this->getReuest($path);

    }


    protected function getReuest(string $path)
    {
        $token = $this->sign("GET",$path,"");
        $url = "https://api.mch.weixin.qq.com{$path}";
        $client = new HttpClient($url);
        $client->setHeader("Authorization",$token,false);
        $resp = $client->get();
        var_dump($resp->getBody());
    }

    protected function postRequest(string $path,string $json)
    {
        $token = $this->sign("POST",$path,$json);
        $url = "https://api.mch.weixin.qq.com{$path}";
        $client = new HttpClient($url);
        $client->setHeader("Authorization",$token,false);
        $resp = $client->postJson($json);
        var_dump($resp->getBody());
    }


    private function sign(string $method,string $path,string $body)
    {
        $time = time();
        $nonce = strtoupper( Random::character(32));
        $body = "{$method}\n{$path}\n{$time}\n{$nonce}\n{$body}\n";
        openssl_sign($body, $raw_sign, $this->config->getMchPrivateKey(), 'sha256WithRSAEncryption');
        $sign = base64_encode($raw_sign);
        $schema = 'WECHATPAY2-SHA256-RSA2048 ';
        return $schema.sprintf('mchid="%s",nonce_str="%s",timestamp="%d",serial_no="%s",signature="%s"',
                $this->config->getMchId(), $nonce, $time, $this->config->getMchCertSerialNo(), $sign);
    }

}