<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/13
 * Time: 16:04
 */

namespace EasySwoole\Pay\WeChat\WeChatPay;

use EasySwoole\Pay\Exceptions\GatewayException;
use EasySwoole\Pay\Exceptions\InvalidArgumentException;
use EasySwoole\Pay\Exceptions\InvalidSignException;
use EasySwoole\Pay\WeChat\RequestBean\Base;
use EasySwoole\Pay\WeChat\RequestBean\PayBase;
use EasySwoole\Pay\WeChat\ResponseBean\Wap as WapResponse;
use EasySwoole\Pay\WeChat\Utility;

class Wap extends AbstractPayBase
{
    /**
     * 发起一次支付
     * @param PayBase $bean
     * @return WapResponse
     * @throws GatewayException
     * @throws InvalidArgumentException
     * @throws InvalidSignException
     */
    public function pay(Base $bean): WapResponse
    {
        // 如果没有定义回调 使用全局回调
        if (empty($bean->getNotifyUrl())) {
            $bean->setNotifyUrl($this->config->getNotifyUrl());
        }

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