<?php

namespace EasySwoole\Pay;

use EasySwoole\Pay\Beans\Alipay\Gateway;
use EasySwoole\Pay\Config\AlipayConfig;
use EasySwoole\Pay\Request\Alipay\PreQrCode;

class Alipay
{

    private string $gateway;
    function __construct(
        protected AlipayConfig $config
    )
    {
        if($this->config->getGateWay() == Gateway::PRODUCE){
            $this->gateway = 'https://openapi.alipay.com/gateway.do';
        }else{
            $this->gateway = 'https://openapi.alipaydev.com/gateway.do';
        }
    }


    function preQrCode(PreQrCode $request)
    {

    }
}