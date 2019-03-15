<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/15
 * Time: 14:21
 */

namespace EasySwoole\Pay\WeChat\AbstractInterface;

use EasySwoole\Pay\WeChat\RequestBean\PayBase;

interface WeChatPay
{
    public function pay(PayBase $base);
}