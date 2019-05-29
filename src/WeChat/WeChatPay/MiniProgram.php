<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/28
 * Time: 18:15
 */

namespace EasySwoole\Pay\WeChat\WeChatPay;

use EasySwoole\Pay\Exceptions\GatewayException;
use EasySwoole\Pay\Exceptions\InvalidArgumentException;
use EasySwoole\Pay\Exceptions\InvalidSignException;
use EasySwoole\Pay\WeChat\RequestBean\Base;
use EasySwoole\Pay\WeChat\RequestBean\PayBase;
use EasySwoole\Pay\WeChat\ResponseBean\MiniProgram as MiniProgramResponse;
use EasySwoole\Pay\WeChat\Utility;

class MiniProgram extends AbstractPayBase
{
    /**
     * 发起一次支付
     * @param PayBase $bean 这里实际上会给入对应支付方法的Bean
     * @return MiniProgramResponse
     * @throws GatewayException
     * @throws InvalidArgumentException
     * @throws InvalidSignException
     */
    public function pay(Base $bean): MiniProgramResponse
    {
        $utility = new Utility($this->config);

        // 如果没有定义回调 使用全局回调
        if (empty($bean->getNotifyUrl())) {
            $bean->setNotifyUrl($this->config->getNotifyUrl());
        }

        $result = $utility->requestApi($this->requestPath(), $bean);
        $result = [
            'appId' => $this->config->getMiniAppId(),
            'package' => 'prepay_id=' . $result['prepay_id'],
            'signType' => empty($bean->getSignType()) ? 'MD5' : $bean->getSignType()
        ];
        $response = new MiniProgramResponse($result);
        $response->setPaySign($utility->generateSign($response->toArray()));
        return $response;
    }

    /**
     * 设置支付路径
     * @return string
     */
    public function requestPath(): string
    {
        return '/pay/unifiedorder';
    }
}