<?php

namespace EasySwoole\Pay\Response\Wechat;

use EasySwoole\Pay\Beans\Wechat\BaseBean;
use EasySwoole\Pay\Config\WechatConfig;
use EasySwoole\Pay\Exception\Wechat;
use EasySwoole\Utility\Random;

class JsApi extends BaseBean
{
    public string $prepay_id;

    public string $appId;

    public string $timeStamp;

    public string $nonceStr;

    public string $package;

    public string $signType = 'RSA';

    public string $paySign;


    protected function initialize(): void
    {
        $this->package = "prepay_id={$this->prepay_id}";
        $this->nonceStr = strtoupper(Random::character(32));
        $this->timeStamp = (string)time();
    }

    public function makeSign(WechatConfig $config):string
    {
        $body = "{$this->appId}\n{$this->timeStamp}\n{$this->nonceStr}\n{$this->package}\n";
        if (!openssl_sign($body, $signature, $config->getMchApiClientKey(), OPENSSL_ALGO_SHA256)) {
            throw new Wechat('Signing the input $message failed, please checking your $privateKey whether or nor correct.');
        }

        $this->paySign = base64_encode($signature);
        return $this->paySign;
    }
}
