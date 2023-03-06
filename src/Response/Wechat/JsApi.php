<?php

namespace EasySwoole\Pay\Response\Wechat;

use EasySwoole\Component\Process\Config;
use EasySwoole\Pay\Config\WechatConfig;
use EasySwoole\Pay\Exception\Wechat;
use EasySwoole\Spl\SplBean;
use EasySwoole\Utility\Random;

class JsApi extends SplBean
{
    protected $prepay_id;

    protected $appId;

    protected $timeStamp;

    protected $nonceStr;

    protected $package;

    protected $signType = 'RSA';

    protected $paySign;

    /**
     * @return mixed
     */
    public function getPrepayId()
    {
        return $this->prepay_id;
    }

    /**
     * @param mixed $prepay_id
     */
    public function setPrepayId($prepay_id): void
    {
        $this->prepay_id = $prepay_id;
    }

    protected function initialize(): void
    {
        $this->package = "prepay_id={$this->prepay_id}";
        $this->nonceStr = strtoupper(Random::character(32));
        $this->timeStamp = time();
    }

    function makeSign(WechatConfig $config):string
    {
        $body = "{$this->appId}\n{$this->timeStamp}\n{$this->nonceStr}\n{$this->package}\n";
        if (!openssl_sign($body, $signature, $config->getMchPrivateKey(), OPENSSL_ALGO_SHA256)) {
            throw new Wechat('Signing the input $message failed, please checking your $privateKey whether or nor correct.');
        }

        $this->paySign = base64_encode($signature);
        return $this->paySign;
    }


}