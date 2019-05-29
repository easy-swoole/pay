<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/13
 * Time: 16:04
 */

namespace EasySwoole\Pay\WeChat\WeChatPay;

use EasySwoole\Pay\WeChat\RequestBean\Base;
use EasySwoole\Pay\WeChat\ResponseBean\Wap as WapResponse;
use EasySwoole\Pay\WeChat\Utility;

class Wap extends AbstractPayBase
{
    /**
     * H5支付
     * @param Base $bean
     * @return WapResponse
     * @throws \EasySwoole\Pay\Exceptions\GatewayException
     * @throws \EasySwoole\Pay\Exceptions\InvalidArgumentException
     * @throws \EasySwoole\Pay\Exceptions\InvalidSignException
     */
    public function pay(Base $bean): WapResponse
    {
        $bean->setNotifyUrl($this->config->getNotifyUrl());
        $utility = new Utility($this->config);
        $result = $utility->requestApi($this->requestPath(), $bean);
        return new WapResponse((array)$result);
    }

    /**
     * 请求地址
     * @return string
     */
    protected function requestPath(): string
    {
        return '/pay/unifiedorder';
    }
}