<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/12
 * Time: 16:49
 */

namespace EasySwoole\Pay\WeChat\WeChatPay;


use EasySwoole\Pay\WeChat\Config;

abstract class AbstractPayBase
{
    const REQUEST_URL = '/pay/unifiedorder';

    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function getRequestUrl()
    {
        return $this->config->getGateWay() . static::REQUEST_URL;
    }
}