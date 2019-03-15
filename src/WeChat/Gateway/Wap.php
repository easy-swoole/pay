<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/13
 * Time: 16:04
 */

namespace EasySwoole\Pay\WeChat\Gateway;

use \EasySwoole\Pay\WeChat\RequestBean\Wap as WapRequest;
use EasySwoole\Spl\SplArray;

class Wap extends PayBase
{
    public function pay(WapRequest $wap):SplArray
    {
        $wap->setNotifyUrl($this->config->getNotifyUrl());
        return $this->config->requestApi($this->getRequestUrl(), $wap);
    }
}