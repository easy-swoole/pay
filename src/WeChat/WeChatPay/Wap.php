<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/13
 * Time: 16:04
 */

namespace EasySwoole\Pay\WeChat\WeChatPay;

use EasySwoole\Pay\WeChat\AbstractInterface\WeChatPay;
use EasySwoole\Pay\WeChat\ResponseBean\Wap as WapResponse;
use EasySwoole\Pay\WeChat\RequestBean\PayBase as PayBaseBean;

class Wap extends PayBase implements WeChatPay
{
    /**
     * H5支付
     * @param PayBaseBean $bean
     * @return WapResponse
     * @throws \EasySwoole\Pay\Exceptions\GatewayException
     * @throws \EasySwoole\Pay\Exceptions\InvalidArgumentException
     * @throws \EasySwoole\Pay\Exceptions\InvalidSignException
     */
    public function pay(PayBaseBean $bean): WapResponse
    {
        $bean->setNotifyUrl($this->config->getNotifyUrl());
        return new WapResponse((array)$this->config->requestApi($this->getRequestUrl(), $bean));
    }
}