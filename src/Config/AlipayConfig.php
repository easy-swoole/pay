<?php

namespace EasySwoole\Pay\Config;

use EasySwoole\Pay\AliPay\GateWay;
use EasySwoole\Spl\SplBean;

class AlipayConfig extends SplBean
{
    protected $appId;
    protected $notifyUrl;
    protected $returnUrl;
    protected $publicKey;
    protected $privateKey;
    protected $gateWay = GateWay::SANDBOX;
    protected $charset = "utf-8";
    protected $format = "JSON";
    protected $signType = "RSA2";
    protected $apiVersion = "1.0";
    protected $appAuthToken;
}