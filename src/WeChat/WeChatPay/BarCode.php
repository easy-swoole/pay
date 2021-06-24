<?php


namespace EasySwoole\Pay\WeChat\WeChatPay;


use EasySwoole\Pay\WeChat\RequestBean\Base;
use EasySwoole\Pay\WeChat\ResponseBean\BarCode as MicroPayResponse;
use EasySwoole\Pay\WeChat\Utility;

class BarCode extends AbstractPayBase
{
    protected function requestPath(): string
    {
        return '/pay/micropay';
    }
    function pay(Base $bean)
    {
        if ($bean->getNotifyUrl()===null){
            $bean->setNotifyUrl( $this->config->getNotifyUrl() );
        }
        $utility      = new Utility( $this->config );
        $result       = $utility->requestApi( $this->requestPath(), $bean );
        return new MicroPayResponse($result->getArrayCopy());
    }
}
