<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:05
 */

namespace EasySwoole\Pay\AliPay;


use EasySwoole\Spl\SplEnum;

class GateWay extends SplEnum
{
    const NORMAL = 'https://openapi.alipay.com/gateway.do';
    const SANDBOX = 'https://openapi.alipaydev.com/gateway.do';
}