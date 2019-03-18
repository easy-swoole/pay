<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/18
 * Time: 11:34
 */

namespace EasySwoole\Pay\WeChat\WeChatPay;


use EasySwoole\Pay\WeChat\RequestBean\Base;
use \EasySwoole\Pay\WeChat\ResponseBean\Scan as ScanResponse;
use EasySwoole\Pay\WeChat\Utility;

class Scan extends AbstractPayBase
{
    protected function requestPath(): string
    {
        return '/pay/unifiedorder';
    }

    public function pay(Base $bean): ScanResponse
    {
        $bean->setNotifyUrl($this->config->getNotifyUrl());
        $utility = new Utility($this->config);
        $result = $utility->requestApi($this->requestPath(), $bean);
        return new ScanResponse((array)$result);
    }
}