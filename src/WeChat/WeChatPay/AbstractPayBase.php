<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/12
 * Time: 16:49
 */

namespace EasySwoole\Pay\WeChat\WeChatPay;


use EasySwoole\Pay\WeChat\Config;
use EasySwoole\Pay\WeChat\RequestBean\Base;

abstract class AbstractPayBase
{
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    abstract protected function requestPath():string ;
    abstract function pay(Base $bean);
}