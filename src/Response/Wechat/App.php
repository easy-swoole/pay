<?php

namespace EasySwoole\Pay\Response\Wechat;

use EasySwoole\Pay\Config\WechatConfig;
use EasySwoole\Pay\Exception\Wechat;
use EasySwoole\Spl\SplBean;
use EasySwoole\Utility\Random;

class App extends SplBean
{
    public string $appId;

    public string $partnerId;

    public string $prepayId;

    public string $packageValue = 'Sign=WXPay';

    public string $package = 'Sign=WXPay';

    public string $nonceStr;

    public string $timeStamp;

    public string $sign;

    protected function initialize(): void
    {
        $this->nonceStr = strtoupper(Random::character(32));
        $this->timeStamp = (string)time();
    }

    public function makeSign(WechatConfig $config): string
    {
        $body = "{$this->appId}\n{$this->timeStamp}\n{$this->nonceStr}\n{$this->prepayId}\n";
        if (!openssl_sign($body, $signature, $config->getMchApiClientKey(), OPENSSL_ALGO_SHA256)) {
            throw new Wechat('Signing APP payment parameters failed.');
        }

        $this->sign = base64_encode($signature);
        return $this->sign;
    }

    public function getPrepayId(): string
    {
        return $this->prepayId;
    }

    public function setPrepayId(string $prepayId): void
    {
        $this->prepayId = $prepayId;
    }
}
