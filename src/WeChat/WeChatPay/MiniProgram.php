<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/28
 * Time: 18:15
 */

namespace EasySwoole\Pay\WeChat\WeChatPay;


use EasySwoole\Pay\WeChat\RequestBean\Base;
use EasySwoole\Pay\WeChat\ResponseBean\MiniProgram as MiniProgramResponse;
use EasySwoole\Pay\WeChat\Utility;

class MiniProgram extends AbstractPayBase
{
    public function requestPath(): string
    {
        return '/pay/unifiedorder';
    }

    public function pay(Base $bean):MiniProgramResponse
    {
        $utility = new Utility($this->config);
        $bean->setNotifyUrl($this->config->getNotifyUrl());
        $result = $utility->requestApi($this->requestPath(), $bean);
        $result = [
            'appId' => $this->config->getAppId(),
            'package' => 'prepay_id=' . $result['prepay_id'],
            'signType' => empty($bean->getSignType()) ? 'MD5' : $bean->getSignType()
        ];
        $response = new MiniProgramResponse($result);
        $response->setPaySign($utility->generateSign($response->toArray()));
        return $response;
    }
}