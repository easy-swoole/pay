<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/18
 * Time: 11:34
 */

namespace EasySwoole\Pay\WeChat\WeChatPay;

use EasySwoole\Pay\Exceptions\GatewayException;
use EasySwoole\Pay\Exceptions\InvalidArgumentException;
use EasySwoole\Pay\Exceptions\InvalidSignException;
use EasySwoole\Pay\WeChat\RequestBean\Base;
use EasySwoole\Pay\WeChat\RequestBean\PayBase;
use EasySwoole\Pay\WeChat\ResponseBean\Scan as ScanResponse;
use EasySwoole\Pay\WeChat\Utility;

/**
 * 扫码支付
 * Class Scan
 * @package EasySwoole\Pay\WeChat\WeChatPay
 */
class Scan extends AbstractPayBase
{
    /**
     * 发起一次支付
     * @param PayBase $bean
     * @return ScanResponse
     * @throws GatewayException
     * @throws InvalidArgumentException
     * @throws InvalidSignException
     */
    public function pay(Base $bean): ScanResponse
    {
        // 如果没有定义回调 使用全局回调
        if (empty($bean->getNotifyUrl())) {
            $bean->setNotifyUrl($this->config->getNotifyUrl());
        }

        $utility = new Utility($this->config);
        $result = $utility->requestApi($this->requestPath(), $bean);
        return new ScanResponse((array)$result);
    }

    /**
     * 设置支付路径
     * @return string
     */
    protected function requestPath(): string
    {
        return '/pay/unifiedorder';
    }
}